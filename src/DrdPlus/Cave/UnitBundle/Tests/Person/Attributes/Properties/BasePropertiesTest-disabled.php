<?php
namespace DrdPlus\Cave\UnitBundle\Tests\Person\Attributes\Properties;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Agility;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Charisma;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\BaseProperties;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Intelligence;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Knack;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Strength;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Will;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Gender;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Race;
use DrdPlus\Cave\UnitBundle\Person\Person;
use DrdPlus\Cave\UnitBundle\Tests\TestWithMockery;
use Granam\Strict\Object\StrictObject;

class BasePropertiesTest extends TestWithMockery
{

    /**
     * @returns BaseProperties
     *
     * @test
     */
    public function can_create_instance()
    {
        $instance = new BaseProperties();
        $this->assertNotNull($instance);

        return $instance;
    }

    /**
     * @param BaseProperties $baseProperties
     *
     * @test
     * @depends can_create_instance
     */
    public function is_a_strict_object(BaseProperties $baseProperties)
    {
        $this->assertInstanceOf(StrictObject::class, $baseProperties);
    }

    /**
     * @test
     * @depends can_create_instance
     * @expectedException \DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Exceptions\PersonIsNotSet
     */
    public function setting_property_before_person_cause_exception()
    {
        /** @var \Mockery\MockInterface|Strength $strength */
        $strength = \Mockery::mock(Strength::class);
        $strength->shouldReceive('getTypeName')
            ->andReturn('strength');
        $strength->shouldReceive('getValue')
            ->andReturn($baseStrengthValue = 2);
        $baseProperties = new BaseProperties();
        $baseProperties->setBaseStrength($strength);
    }

    /**
     * @return BaseProperties
     *
     * @test
     * @depends setting_property_before_person_cause_exception
     */
    public function person_can_be_set()
    {
        $baseProperties = new BaseProperties();
        /** @var Person|\Mockery\MockInterface $person */
        $person = \Mockery::mock(Person::class);
        $person->shouldReceive('getBaseProperties')
            ->atLeast()->once()
            ->andReturn($baseProperties);
        $baseProperties->setPerson($person);
        $this->assertSame($person, $baseProperties->getPerson());

        return $baseProperties;
    }

    /**
     * @param BaseProperties $baseProperties
     *
     * @test
     * @depends person_can_be_set
     * @expectedException \LogicException
     */
    public function setting_another_person_cause_exception(BaseProperties $baseProperties)
    {
        /** @var \Mockery\MockInterface $previousPerson */
        $previousPerson = $baseProperties->getPerson();
        $previousPerson->shouldReceive('getId')
            ->andReturn(1);
        /** @var \Mockery\MockInterface|Person $newPerson */
        $newPerson = \Mockery::mock(Person::class);
        $newPerson->shouldReceive('getId')
            ->andReturn(2);
        $newPerson->shouldReceive('getBaseProperties')
            ->andReturn($baseProperties);
        $baseProperties->setPerson($newPerson);
    }

    /**
     * @param BaseProperties $baseProperties
     *
     * @test
     * @depends person_can_be_set
     * @expectedException \LogicException
     */
    public function another_person_even_without_id_cause_exception(BaseProperties $baseProperties)
    {
        /** @var Person|\Mockery\MockInterface $previousPerson */
        $previousPerson = $baseProperties->getPerson();
        $previousPerson->shouldReceive('getId')
            ->andReturnNull(); // no ID at all - not saved yet
        $this->assertInstanceOf(Person::class, $baseProperties->getPerson());
        /** @var Person|\Mockery\MockInterface $anotherPerson */
        $anotherPerson = \Mockery::mock(Person::class);
        $anotherPerson->shouldReceive('getId')
            ->andReturnNull(); // again not saved entity
        $anotherPerson->shouldReceive('getBaseProperties')
            ->andReturn($baseProperties);
        $baseProperties->setPerson($anotherPerson);
    }

    /**
     * @test
     * @depends person_can_be_set
     */
    public function maximal_base_strength_can_be_calculated()
    {
        $baseProperties = $this->getBaseProperties();
        /** @var \Mockery\MockInterface|Gender $gender */
        $gender = $baseProperties->getPerson()->getGender();
        /** @var \Mockery\MockInterface|Race $race */
        $race = $baseProperties->getPerson()->getRace();
        $race->shouldReceive('getStrengthModifier')
            ->with($gender)
            ->andReturn($genderStrengthModifier = 12345);

        $this->assertSame(
            3 /* maximal base property increase (without race gender modifier) */ + $genderStrengthModifier,
            $baseProperties->calculateMaximalBaseStrength()
        );
    }

    /**
     * @return BaseProperties
     */
    private function getBaseProperties()
    {
        $baseProperties = new BaseProperties();
        /** @var \Mockery\MockInterface|Person $person */
        $person = \Mockery::mock(Person::class);
        $person->shouldReceive('getRace')
            ->andReturn(\Mockery::mock(Race::class));
        $person->shouldReceive('getGender')
            ->andReturn(\Mockery::mock(Gender::class));
        $person->shouldReceive('getBaseProperties')
            ->andReturn($baseProperties);
        $baseProperties->setPerson($person);

        return $baseProperties;
    }

    /**
     * @return BaseProperties
     *
     * @test
     * @depends maximal_base_strength_can_be_calculated
     */
    public function base_strength_can_be_set()
    {
        /** @var \Mockery\MockInterface|Strength $strength */
        $strength = \Mockery::mock(Strength::class);
        $strength->shouldReceive('getTypeName')
            ->andReturn('strength');
        $strength->shouldReceive('getValue')
            ->andReturn($baseStrengthValue = 3 /* maximal base strength (without race gender modifier) */);

        $baseProperties = $this->getBaseProperties();

        /** @var \Mockery\MockInterface|Gender $gender */
        $gender = $baseProperties->getPerson()->getGender();
        /** @var \Mockery\MockInterface|Race $race */
        $race = $baseProperties->getPerson()->getRace();
        $race->shouldReceive('getStrengthModifier')
            ->with($gender)
            ->andReturn($genderStrengthModifier = 0);

        $baseProperties->setBaseStrength($strength);
        $this->assertSame($baseStrengthValue, $baseProperties->getBaseStrength()->getValue());

        return $baseProperties;
    }

    /**
     * @test
     * @depends base_strength_can_be_set
     * @expectedException \DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Exceptions\BasePropertyValueExceeded
     */
    public function too_high_base_strength_cause_exception()
    {
        /** @var \Mockery\MockInterface|Strength $strength */
        $strength = \Mockery::mock(Strength::class);
        $strength->shouldReceive('getTypeName')
            ->andReturn('strength');
        $strength->shouldReceive('getValue')
            ->andReturn($baseStrengthValue = 4 /* higher than maximal base strength, including gender modifier for this case */);

        $baseProperties = $this->getBaseProperties();

        /** @var \Mockery\MockInterface|Gender $gender */
        $gender = $baseProperties->getPerson()->getGender();
        /** @var \Mockery\MockInterface|Race $race */
        $race = $baseProperties->getPerson()->getRace();
        $race->shouldReceive('getStrengthModifier')
            ->with($gender)
            ->andReturn($genderStrengthModifier = 0);

        $baseProperties->setBaseStrength($strength);
        $this->assertSame($baseStrengthValue, $baseProperties->getBaseStrength()->getValue());
    }

    /**
     * @param BaseProperties $baseProperties
     *
     * @test
     * @depends base_strength_can_be_set
     * @expectedException \DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Exceptions\BasePropertyIsAlreadySet
     */
    public function setting_another_base_strength_cause_exception(BaseProperties $baseProperties)
    {
        /** @var \Mockery\MockInterface|Strength $anotherStrength */
        $anotherStrength = \Mockery::mock(Strength::class);
        $anotherStrength->shouldReceive('getTypeName')
            ->andReturn('strength');

        $baseProperties->setBaseStrength($anotherStrength);
    }
    
    /**
     * @test
     * @depends person_can_be_set
     */
    public function maximal_base_agility_can_be_calculated()
    {
        $baseProperties = $this->getBaseProperties();
        /** @var \Mockery\MockInterface|Gender $gender */
        $gender = $baseProperties->getPerson()->getGender();
        /** @var \Mockery\MockInterface|Race $race */
        $race = $baseProperties->getPerson()->getRace();
        $race->shouldReceive('getAgilityModifier')
            ->with($gender)
            ->andReturn($genderAgilityModifier = 12345);

        $this->assertSame(
            3 /* maximal base property increase (without race gender modifier) */ + $genderAgilityModifier,
            $baseProperties->calculateMaximalBaseAgility()
        );
    }

    /**
     * @return BaseProperties
     * 
     * @test
     * @depends maximal_base_agility_can_be_calculated
     */
    public function base_agility_can_be_set()
    {
        /** @var \Mockery\MockInterface|Agility $agility */
        $agility = \Mockery::mock(Agility::class);
        $agility->shouldReceive('getTypeName')
            ->andReturn('agility');
        $agility->shouldReceive('getValue')
            ->andReturn($baseAgilityValue = 3 /* maximal base agility (without race gender modifier) */);

        $baseProperties = $this->getBaseProperties();

        /** @var \Mockery\MockInterface|Gender $gender */
        $gender = $baseProperties->getPerson()->getGender();
        /** @var \Mockery\MockInterface|Race $race */
        $race = $baseProperties->getPerson()->getRace();
        $race->shouldReceive('getAgilityModifier')
            ->with($gender)
            ->andReturn($genderAgilityModifier = 0);

        $baseProperties->setBaseAgility($agility);
        $this->assertSame($baseAgilityValue, $baseProperties->getBaseAgility()->getValue());
        
        return $baseProperties;
    }

    /**
     * @test
     * @depends base_agility_can_be_set
     * @expectedException \DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Exceptions\BasePropertyValueExceeded
     */
    public function too_high_base_agility_cause_exception()
    {
        /** @var \Mockery\MockInterface|Agility $agility */
        $agility = \Mockery::mock(Agility::class);
        $agility->shouldReceive('getTypeName')
            ->andReturn('agility');
        $agility->shouldReceive('getValue')
            ->andReturn($baseAgilityValue = 4 /* higher than maximal base agility, including gender modifier for this case */);

        $baseProperties = $this->getBaseProperties();

        /** @var \Mockery\MockInterface|Gender $gender */
        $gender = $baseProperties->getPerson()->getGender();
        /** @var \Mockery\MockInterface|Race $race */
        $race = $baseProperties->getPerson()->getRace();
        $race->shouldReceive('getAgilityModifier')
            ->with($gender)
            ->andReturn($genderAgilityModifier = 0);

        $baseProperties->setBaseAgility($agility);
        $this->assertSame($baseAgilityValue, $baseProperties->getBaseAgility()->getValue());
    }

    /**
     * @param BaseProperties $baseProperties
     *
     * @test
     * @depends base_agility_can_be_set
     * @expectedException \DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Exceptions\BasePropertyIsAlreadySet
     */
    public function setting_another_base_agility_cause_exception(BaseProperties $baseProperties)
    {
        /** @var \Mockery\MockInterface|Agility $anotherAgility */
        $anotherAgility = \Mockery::mock(Agility::class);
        $anotherAgility->shouldReceive('getTypeName')
            ->andReturn('agility');

        $baseProperties->setBaseAgility($anotherAgility);
    }

    /**
     * @test
     * @depends person_can_be_set
     */
    public function maximal_base_knack_can_be_calculated()
    {
        $baseProperties = $this->getBaseProperties();
        /** @var \Mockery\MockInterface|Gender $gender */
        $gender = $baseProperties->getPerson()->getGender();
        /** @var \Mockery\MockInterface|Race $race */
        $race = $baseProperties->getPerson()->getRace();
        $race->shouldReceive('getKnackModifier')
            ->with($gender)
            ->andReturn($genderKnackModifier = 12345);

        $this->assertSame(
            3 /* maximal base property increase (without race gender modifier) */ + $genderKnackModifier,
            $baseProperties->calculateMaximalBaseKnack()
        );
    }

    /**
     * @return BaseProperties
     * 
     * @test
     * @depends maximal_base_knack_can_be_calculated
     */
    public function base_knack_can_be_set()
    {
        /** @var \Mockery\MockInterface|Knack $knack */
        $knack = \Mockery::mock(Knack::class);
        $knack->shouldReceive('getTypeName')
            ->andReturn('knack');
        $knack->shouldReceive('getValue')
            ->andReturn($baseKnackValue = 3 /* maximal base knack (without race gender modifier) */);

        $baseProperties = $this->getBaseProperties();

        /** @var \Mockery\MockInterface|Gender $gender */
        $gender = $baseProperties->getPerson()->getGender();
        /** @var \Mockery\MockInterface|Race $race */
        $race = $baseProperties->getPerson()->getRace();
        $race->shouldReceive('getKnackModifier')
            ->with($gender)
            ->andReturn($genderKnackModifier = 0);

        $baseProperties->setBaseKnack($knack);
        $this->assertSame($baseKnackValue, $baseProperties->getBaseKnack()->getValue());
        
        return $baseProperties;
    }

    /**
     * @test
     * @depends base_knack_can_be_set
     * @expectedException \DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Exceptions\BasePropertyValueExceeded
     */
    public function too_high_base_knack_cause_exception()
    {
        /** @var \Mockery\MockInterface|Knack $knack */
        $knack = \Mockery::mock(Knack::class);
        $knack->shouldReceive('getTypeName')
            ->andReturn('knack');
        $knack->shouldReceive('getValue')
            ->andReturn($baseKnackValue = 4 /* higher than maximal base knack, including gender modifier for this case */);

        $baseProperties = $this->getBaseProperties();

        /** @var \Mockery\MockInterface|Gender $gender */
        $gender = $baseProperties->getPerson()->getGender();
        /** @var \Mockery\MockInterface|Race $race */
        $race = $baseProperties->getPerson()->getRace();
        $race->shouldReceive('getKnackModifier')
            ->with($gender)
            ->andReturn($genderKnackModifier = 0);

        $baseProperties->setBaseKnack($knack);
        $this->assertSame($baseKnackValue, $baseProperties->getBaseKnack()->getValue());
    }

    /**
     * @param BaseProperties $baseProperties
     *
     * @test
     * @depends base_knack_can_be_set
     * @expectedException \DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Exceptions\BasePropertyIsAlreadySet
     */
    public function setting_another_base_knack_cause_exception(BaseProperties $baseProperties)
    {
        /** @var \Mockery\MockInterface|Knack $anotherKnack */
        $anotherKnack = \Mockery::mock(Knack::class);
        $anotherKnack->shouldReceive('getTypeName')
            ->andReturn('knack');

        $baseProperties->setBaseKnack($anotherKnack);
    }

    /**
     * @test
     * @depends person_can_be_set
     */
    public function maximal_base_will_can_be_calculated()
    {
        $baseProperties = $this->getBaseProperties();
        /** @var \Mockery\MockInterface|Gender $gender */
        $gender = $baseProperties->getPerson()->getGender();
        /** @var \Mockery\MockInterface|Race $race */
        $race = $baseProperties->getPerson()->getRace();
        $race->shouldReceive('getWillModifier')
            ->with($gender)
            ->andReturn($genderWillModifier = 12345);

        $this->assertSame(
            3 /* maximal base property increase (without race gender modifier) */ + $genderWillModifier,
            $baseProperties->calculateMaximalBaseWill()
        );
    }

    /**
     * @return BaseProperties
     *
     * @test
     * @depends maximal_base_will_can_be_calculated
     */
    public function base_will_can_be_set()
    {
        /** @var \Mockery\MockInterface|Will $will */
        $will = \Mockery::mock(Will::class);
        $will->shouldReceive('getTypeName')
            ->andReturn('will');
        $will->shouldReceive('getValue')
            ->andReturn($baseWillValue = 3 /* maximal base will (without race gender modifier) */);

        $baseProperties = $this->getBaseProperties();

        /** @var \Mockery\MockInterface|Gender $gender */
        $gender = $baseProperties->getPerson()->getGender();
        /** @var \Mockery\MockInterface|Race $race */
        $race = $baseProperties->getPerson()->getRace();
        $race->shouldReceive('getWillModifier')
            ->with($gender)
            ->andReturn($genderWillModifier = 0);

        $baseProperties->setBaseWill($will);
        $this->assertSame($baseWillValue, $baseProperties->getBaseWill()->getValue());

        return $baseProperties;
    }

    /**
     * @test
     * @depends base_will_can_be_set
     * @expectedException \DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Exceptions\BasePropertyValueExceeded
     */
    public function too_high_base_will_cause_exception()
    {
        /** @var \Mockery\MockInterface|Will $will */
        $will = \Mockery::mock(Will::class);
        $will->shouldReceive('getTypeName')
            ->andReturn('will');
        $will->shouldReceive('getValue')
            ->andReturn($baseWillValue = 4 /* higher than maximal base will, including gender modifier for this case */);

        $baseProperties = $this->getBaseProperties();

        /** @var \Mockery\MockInterface|Gender $gender */
        $gender = $baseProperties->getPerson()->getGender();
        /** @var \Mockery\MockInterface|Race $race */
        $race = $baseProperties->getPerson()->getRace();
        $race->shouldReceive('getWillModifier')
            ->with($gender)
            ->andReturn($genderWillModifier = 0);

        $baseProperties->setBaseWill($will);
        $this->assertSame($baseWillValue, $baseProperties->getBaseWill()->getValue());
    }

    /**
     * @param BaseProperties $baseProperties
     *
     * @test
     * @depends base_will_can_be_set
     * @expectedException \DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Exceptions\BasePropertyIsAlreadySet
     */
    public function setting_another_base_will_cause_exception(BaseProperties $baseProperties)
    {
        /** @var \Mockery\MockInterface|Will $anotherWill */
        $anotherWill = \Mockery::mock(Will::class);
        $anotherWill->shouldReceive('getTypeName')
            ->andReturn('will');

        $baseProperties->setBaseWill($anotherWill);
    }
    
    /**
     * @test
     * @depends person_can_be_set
     */
    public function maximal_base_intelligence_can_be_calculated()
    {
        $baseProperties = $this->getBaseProperties();
        /** @var \Mockery\MockInterface|Gender $gender */
        $gender = $baseProperties->getPerson()->getGender();
        /** @var \Mockery\MockInterface|Race $race */
        $race = $baseProperties->getPerson()->getRace();
        $race->shouldReceive('getIntelligenceModifier')
            ->with($gender)
            ->andReturn($genderIntelligenceModifier = 12345);

        $this->assertSame(
            3 /* maximal base property increase (without race gender modifier) */ + $genderIntelligenceModifier,
            $baseProperties->calculateMaximalBaseIntelligence()
        );
    }

    /**
     * @return BaseProperties
     *
     * @test
     * @depends maximal_base_intelligence_can_be_calculated
     */
    public function base_intelligence_can_be_set()
    {
        /** @var \Mockery\MockInterface|Intelligence $intelligence */
        $intelligence = \Mockery::mock(Intelligence::class);
        $intelligence->shouldReceive('getTypeName')
            ->andReturn('intelligence');
        $intelligence->shouldReceive('getValue')
            ->andReturn($baseIntelligenceValue = 3 /* maximal base intelligence (without race gender modifier) */);

        $baseProperties = $this->getBaseProperties();

        /** @var \Mockery\MockInterface|Gender $gender */
        $gender = $baseProperties->getPerson()->getGender();
        /** @var \Mockery\MockInterface|Race $race */
        $race = $baseProperties->getPerson()->getRace();
        $race->shouldReceive('getIntelligenceModifier')
            ->with($gender)
            ->andReturn($genderIntelligenceModifier = 0);

        $baseProperties->setBaseIntelligence($intelligence);
        $this->assertSame($baseIntelligenceValue, $baseProperties->getBaseIntelligence()->getValue());

        return $baseProperties;
    }

    /**
     * @test
     * @depends base_intelligence_can_be_set
     * @expectedException \DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Exceptions\BasePropertyValueExceeded
     */
    public function too_high_base_intelligence_cause_exception()
    {
        /** @var \Mockery\MockInterface|Intelligence $intelligence */
        $intelligence = \Mockery::mock(Intelligence::class);
        $intelligence->shouldReceive('getTypeName')
            ->andReturn('intelligence');
        $intelligence->shouldReceive('getValue')
            ->andReturn($baseIntelligenceValue = 4 /* higher than maximal base intelligence, including gender modifier for this case */);

        $baseProperties = $this->getBaseProperties();

        /** @var \Mockery\MockInterface|Gender $gender */
        $gender = $baseProperties->getPerson()->getGender();
        /** @var \Mockery\MockInterface|Race $race */
        $race = $baseProperties->getPerson()->getRace();
        $race->shouldReceive('getIntelligenceModifier')
            ->with($gender)
            ->andReturn($genderIntelligenceModifier = 0);

        $baseProperties->setBaseIntelligence($intelligence);
        $this->assertSame($baseIntelligenceValue, $baseProperties->getBaseIntelligence()->getValue());
    }

    /**
     * @param BaseProperties $baseProperties
     *
     * @test
     * @depends base_intelligence_can_be_set
     * @expectedException \DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Exceptions\BasePropertyIsAlreadySet
     */
    public function setting_another_base_intelligence_cause_exception(BaseProperties $baseProperties)
    {
        /** @var \Mockery\MockInterface|Intelligence $anotherIntelligence */
        $anotherIntelligence = \Mockery::mock(Intelligence::class);
        $anotherIntelligence->shouldReceive('getTypeName')
            ->andReturn('intelligence');

        $baseProperties->setBaseIntelligence($anotherIntelligence);
    }
    
    /**
     * @test
     * @depends person_can_be_set
     */
    public function maximal_base_charisma_can_be_calculated()
    {
        $baseProperties = $this->getBaseProperties();
        /** @var \Mockery\MockInterface|Gender $gender */
        $gender = $baseProperties->getPerson()->getGender();
        /** @var \Mockery\MockInterface|Race $race */
        $race = $baseProperties->getPerson()->getRace();
        $race->shouldReceive('getCharismaModifier')
            ->with($gender)
            ->andReturn($genderCharismaModifier = 12345);

        $this->assertSame(
            3 /* maximal base property increase (without race gender modifier) */ + $genderCharismaModifier,
            $baseProperties->calculateMaximalBaseCharisma()
        );
    }

    /**
     * @return BaseProperties
     *
     * @test
     * @depends maximal_base_charisma_can_be_calculated
     */
    public function base_charisma_can_be_set()
    {
        /** @var \Mockery\MockInterface|Charisma $charisma */
        $charisma = \Mockery::mock(Charisma::class);
        $charisma->shouldReceive('getTypeName')
            ->andReturn('charisma');
        $charisma->shouldReceive('getValue')
            ->andReturn($baseCharismaValue = 3 /* maximal base charisma (without race gender modifier) */);

        $baseProperties = $this->getBaseProperties();

        /** @var \Mockery\MockInterface|Gender $gender */
        $gender = $baseProperties->getPerson()->getGender();
        /** @var \Mockery\MockInterface|Race $race */
        $race = $baseProperties->getPerson()->getRace();
        $race->shouldReceive('getCharismaModifier')
            ->with($gender)
            ->andReturn($genderCharismaModifier = 0);

        $baseProperties->setBaseCharisma($charisma);
        $this->assertSame($baseCharismaValue, $baseProperties->getBaseCharisma()->getValue());

        return $baseProperties;
    }

    /**
     * @test
     * @depends base_charisma_can_be_set
     * @expectedException \DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Exceptions\BasePropertyValueExceeded
     */
    public function too_high_base_charisma_cause_exception()
    {
        /** @var \Mockery\MockInterface|Charisma $charisma */
        $charisma = \Mockery::mock(Charisma::class);
        $charisma->shouldReceive('getTypeName')
            ->andReturn('charisma');
        $charisma->shouldReceive('getValue')
            ->andReturn($baseCharismaValue = 4 /* higher than maximal base charisma, including gender modifier for this case */);

        $baseProperties = $this->getBaseProperties();

        /** @var \Mockery\MockInterface|Gender $gender */
        $gender = $baseProperties->getPerson()->getGender();
        /** @var \Mockery\MockInterface|Race $race */
        $race = $baseProperties->getPerson()->getRace();
        $race->shouldReceive('getCharismaModifier')
            ->with($gender)
            ->andReturn($genderCharismaModifier = 0);

        $baseProperties->setBaseCharisma($charisma);
        $this->assertSame($baseCharismaValue, $baseProperties->getBaseCharisma()->getValue());
    }

    /**
     * @param BaseProperties $baseProperties
     *
     * @test
     * @depends base_charisma_can_be_set
     * @expectedException \DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Exceptions\BasePropertyIsAlreadySet
     */
    public function setting_another_base_charisma_cause_exception(BaseProperties $baseProperties)
    {
        /** @var \Mockery\MockInterface|Charisma $anotherCharisma */
        $anotherCharisma = \Mockery::mock(Charisma::class);
        $anotherCharisma->shouldReceive('getTypeName')
            ->andReturn('charisma');

        $baseProperties->setBaseCharisma($anotherCharisma);
    }

}
