<?php
namespace DrdPlus\Cave\UnitBundle\Tests\Entity\Attributes\Properties;

use DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties\Agility;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties\Charisma;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties\InitialProperties;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties\Intelligence;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties\Knack;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties\Strength;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties\Will;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Gender;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Race;
use DrdPlus\Cave\UnitBundle\Entity\Person;
use DrdPlus\Cave\UnitBundle\Tests\TestWithMockery;
use Granam\Strict\Object\StrictObject;

class InitialPropertiesTest extends TestWithMockery
{

    /**
     * @returns InitialProperties
     *
     * @test
     */
    public function can_create_instance()
    {
        $instance = new InitialProperties();
        $this->assertNotNull($instance);

        return $instance;
    }

    /**
     * @param InitialProperties $initialProperties
     *
     * @test
     * @depends can_create_instance
     */
    public function is_a_strict_object(InitialProperties $initialProperties)
    {
        $this->assertInstanceOf(StrictObject::class, $initialProperties);
    }

    /**
     * @test
     * @depends can_create_instance
     * @expectedException \DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties\Exceptions\PersonIsNotSet
     */
    public function setting_property_before_person_cause_exception()
    {
        /** @var \Mockery\MockInterface|Strength $strength */
        $strength = \Mockery::mock(Strength::class);
        $strength->shouldReceive('getTypeName')
            ->andReturn('strength');
        $strength->shouldReceive('getValue')
            ->andReturn($initialStrengthValue = 2);
        $initialProperties = new InitialProperties();
        $initialProperties->setInitialStrength($strength);
    }

    /**
     * @return InitialProperties
     *
     * @test
     * @depends setting_property_before_person_cause_exception
     */
    public function person_can_be_set()
    {
        $initialProperties = new InitialProperties();
        /** @var Person $person */
        $person = \Mockery::mock(Person::class);
        $initialProperties->setPerson($person);
        $this->assertSame($person, $initialProperties->getPerson());

        return $initialProperties;
    }

    /**
     * @param InitialProperties $initialProperties
     *
     * @test
     * @depends person_can_be_set
     * @expectedException \DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties\Exceptions\PersonIsAlreadySet
     */
    public function setting_another_person_cause_exception(InitialProperties $initialProperties)
    {
        /** @var \Mockery\MockInterface $previousPerson */
        $previousPerson = $initialProperties->getPerson();
        $previousPerson->shouldReceive('getId')
            ->andReturn(1);
        /** @var \Mockery\MockInterface|Person $newPerson */
        $newPerson = \Mockery::mock(Person::class);
        $newPerson->shouldReceive('getId')
            ->andReturn(2);
        $initialProperties->setPerson($newPerson);
    }

    /**
     * @test
     * @depends person_can_be_set
     */
    public function maximal_initial_strength_can_be_calculated()
    {
        $initialProperties = $this->getInitialProperties();
        /** @var \Mockery\MockInterface|Gender $gender */
        $gender = $initialProperties->getPerson()->getGender();
        /** @var \Mockery\MockInterface|Race $race */
        $race = $initialProperties->getPerson()->getRace();
        $race->shouldReceive('getStrengthModifier')
            ->with($gender)
            ->andReturn($genderStrengthModifier = 12345);

        $this->assertSame(
            3 /* maximal initial property increase (without race gender modifier) */ + $genderStrengthModifier,
            $initialProperties->calculateMaximalInitialStrength()
        );
    }

    /**
     * @return InitialProperties
     */
    private function getInitialProperties()
    {
        $initialProperties = new InitialProperties();
        /** @var \Mockery\MockInterface|Person $person */
        $person = \Mockery::mock(Person::class);
        $person->shouldReceive('getRace')
            ->andReturn(\Mockery::mock(Race::class));
        $person->shouldReceive('getGender')
            ->andReturn(\Mockery::mock(Gender::class));
        $initialProperties->setPerson($person);

        return $initialProperties;
    }

    /**
     * @return InitialProperties
     *
     * @test
     * @depends maximal_initial_strength_can_be_calculated
     */
    public function initial_strength_can_be_set()
    {
        /** @var \Mockery\MockInterface|Strength $strength */
        $strength = \Mockery::mock(Strength::class);
        $strength->shouldReceive('getTypeName')
            ->andReturn('strength');
        $strength->shouldReceive('getValue')
            ->andReturn($initialStrengthValue = 3 /* maximal initial strength (without race gender modifier) */);

        $initialProperties = $this->getInitialProperties();

        /** @var \Mockery\MockInterface|Gender $gender */
        $gender = $initialProperties->getPerson()->getGender();
        /** @var \Mockery\MockInterface|Race $race */
        $race = $initialProperties->getPerson()->getRace();
        $race->shouldReceive('getStrengthModifier')
            ->with($gender)
            ->andReturn($genderStrengthModifier = 0);

        $initialProperties->setInitialStrength($strength);
        $this->assertSame($initialStrengthValue, $initialProperties->getInitialStrength()->getValue());

        return $initialProperties;
    }

    /**
     * @test
     * @depends initial_strength_can_be_set
     * @expectedException \DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties\Exceptions\InitialPropertyValueExceeded
     */
    public function too_high_initial_strength_cause_exception()
    {
        /** @var \Mockery\MockInterface|Strength $strength */
        $strength = \Mockery::mock(Strength::class);
        $strength->shouldReceive('getTypeName')
            ->andReturn('strength');
        $strength->shouldReceive('getValue')
            ->andReturn($initialStrengthValue = 4 /* higher than maximal initial strength, including gender modifier for this case */);

        $initialProperties = $this->getInitialProperties();

        /** @var \Mockery\MockInterface|Gender $gender */
        $gender = $initialProperties->getPerson()->getGender();
        /** @var \Mockery\MockInterface|Race $race */
        $race = $initialProperties->getPerson()->getRace();
        $race->shouldReceive('getStrengthModifier')
            ->with($gender)
            ->andReturn($genderStrengthModifier = 0);

        $initialProperties->setInitialStrength($strength);
        $this->assertSame($initialStrengthValue, $initialProperties->getInitialStrength()->getValue());
    }

    /**
     * @param InitialProperties $initialProperties
     *
     * @test
     * @depends initial_strength_can_be_set
     * @expectedException \DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties\Exceptions\InitialPropertyIsAlreadySet
     */
    public function setting_another_initial_strength_cause_exception(InitialProperties $initialProperties)
    {
        /** @var \Mockery\MockInterface|Strength $anotherStrength */
        $anotherStrength = \Mockery::mock(Strength::class);
        $anotherStrength->shouldReceive('getTypeName')
            ->andReturn('strength');

        $initialProperties->setInitialStrength($anotherStrength);
    }
    
    /**
     * @test
     * @depends person_can_be_set
     */
    public function maximal_initial_agility_can_be_calculated()
    {
        $initialProperties = $this->getInitialProperties();
        /** @var \Mockery\MockInterface|Gender $gender */
        $gender = $initialProperties->getPerson()->getGender();
        /** @var \Mockery\MockInterface|Race $race */
        $race = $initialProperties->getPerson()->getRace();
        $race->shouldReceive('getAgilityModifier')
            ->with($gender)
            ->andReturn($genderAgilityModifier = 12345);

        $this->assertSame(
            3 /* maximal initial property increase (without race gender modifier) */ + $genderAgilityModifier,
            $initialProperties->calculateMaximalInitialAgility()
        );
    }

    /**
     * @return InitialProperties
     * 
     * @test
     * @depends maximal_initial_agility_can_be_calculated
     */
    public function initial_agility_can_be_set()
    {
        /** @var \Mockery\MockInterface|Agility $agility */
        $agility = \Mockery::mock(Agility::class);
        $agility->shouldReceive('getTypeName')
            ->andReturn('agility');
        $agility->shouldReceive('getValue')
            ->andReturn($initialAgilityValue = 3 /* maximal initial agility (without race gender modifier) */);

        $initialProperties = $this->getInitialProperties();

        /** @var \Mockery\MockInterface|Gender $gender */
        $gender = $initialProperties->getPerson()->getGender();
        /** @var \Mockery\MockInterface|Race $race */
        $race = $initialProperties->getPerson()->getRace();
        $race->shouldReceive('getAgilityModifier')
            ->with($gender)
            ->andReturn($genderAgilityModifier = 0);

        $initialProperties->setInitialAgility($agility);
        $this->assertSame($initialAgilityValue, $initialProperties->getInitialAgility()->getValue());
        
        return $initialProperties;
    }

    /**
     * @test
     * @depends initial_agility_can_be_set
     * @expectedException \DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties\Exceptions\InitialPropertyValueExceeded
     */
    public function too_high_initial_agility_cause_exception()
    {
        /** @var \Mockery\MockInterface|Agility $agility */
        $agility = \Mockery::mock(Agility::class);
        $agility->shouldReceive('getTypeName')
            ->andReturn('agility');
        $agility->shouldReceive('getValue')
            ->andReturn($initialAgilityValue = 4 /* higher than maximal initial agility, including gender modifier for this case */);

        $initialProperties = $this->getInitialProperties();

        /** @var \Mockery\MockInterface|Gender $gender */
        $gender = $initialProperties->getPerson()->getGender();
        /** @var \Mockery\MockInterface|Race $race */
        $race = $initialProperties->getPerson()->getRace();
        $race->shouldReceive('getAgilityModifier')
            ->with($gender)
            ->andReturn($genderAgilityModifier = 0);

        $initialProperties->setInitialAgility($agility);
        $this->assertSame($initialAgilityValue, $initialProperties->getInitialAgility()->getValue());
    }

    /**
     * @param InitialProperties $initialProperties
     *
     * @test
     * @depends initial_agility_can_be_set
     * @expectedException \DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties\Exceptions\InitialPropertyIsAlreadySet
     */
    public function setting_another_initial_agility_cause_exception(InitialProperties $initialProperties)
    {
        /** @var \Mockery\MockInterface|Agility $anotherAgility */
        $anotherAgility = \Mockery::mock(Agility::class);
        $anotherAgility->shouldReceive('getTypeName')
            ->andReturn('agility');

        $initialProperties->setInitialAgility($anotherAgility);
    }

    /**
     * @test
     * @depends person_can_be_set
     */
    public function maximal_initial_knack_can_be_calculated()
    {
        $initialProperties = $this->getInitialProperties();
        /** @var \Mockery\MockInterface|Gender $gender */
        $gender = $initialProperties->getPerson()->getGender();
        /** @var \Mockery\MockInterface|Race $race */
        $race = $initialProperties->getPerson()->getRace();
        $race->shouldReceive('getKnackModifier')
            ->with($gender)
            ->andReturn($genderKnackModifier = 12345);

        $this->assertSame(
            3 /* maximal initial property increase (without race gender modifier) */ + $genderKnackModifier,
            $initialProperties->calculateMaximalInitialKnack()
        );
    }

    /**
     * @return InitialProperties
     * 
     * @test
     * @depends maximal_initial_knack_can_be_calculated
     */
    public function initial_knack_can_be_set()
    {
        /** @var \Mockery\MockInterface|Knack $knack */
        $knack = \Mockery::mock(Knack::class);
        $knack->shouldReceive('getTypeName')
            ->andReturn('knack');
        $knack->shouldReceive('getValue')
            ->andReturn($initialKnackValue = 3 /* maximal initial knack (without race gender modifier) */);

        $initialProperties = $this->getInitialProperties();

        /** @var \Mockery\MockInterface|Gender $gender */
        $gender = $initialProperties->getPerson()->getGender();
        /** @var \Mockery\MockInterface|Race $race */
        $race = $initialProperties->getPerson()->getRace();
        $race->shouldReceive('getKnackModifier')
            ->with($gender)
            ->andReturn($genderKnackModifier = 0);

        $initialProperties->setInitialKnack($knack);
        $this->assertSame($initialKnackValue, $initialProperties->getInitialKnack()->getValue());
        
        return $initialProperties;
    }

    /**
     * @test
     * @depends initial_knack_can_be_set
     * @expectedException \DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties\Exceptions\InitialPropertyValueExceeded
     */
    public function too_high_initial_knack_cause_exception()
    {
        /** @var \Mockery\MockInterface|Knack $knack */
        $knack = \Mockery::mock(Knack::class);
        $knack->shouldReceive('getTypeName')
            ->andReturn('knack');
        $knack->shouldReceive('getValue')
            ->andReturn($initialKnackValue = 4 /* higher than maximal initial knack, including gender modifier for this case */);

        $initialProperties = $this->getInitialProperties();

        /** @var \Mockery\MockInterface|Gender $gender */
        $gender = $initialProperties->getPerson()->getGender();
        /** @var \Mockery\MockInterface|Race $race */
        $race = $initialProperties->getPerson()->getRace();
        $race->shouldReceive('getKnackModifier')
            ->with($gender)
            ->andReturn($genderKnackModifier = 0);

        $initialProperties->setInitialKnack($knack);
        $this->assertSame($initialKnackValue, $initialProperties->getInitialKnack()->getValue());
    }

    /**
     * @param InitialProperties $initialProperties
     *
     * @test
     * @depends initial_knack_can_be_set
     * @expectedException \DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties\Exceptions\InitialPropertyIsAlreadySet
     */
    public function setting_another_initial_knack_cause_exception(InitialProperties $initialProperties)
    {
        /** @var \Mockery\MockInterface|Knack $anotherKnack */
        $anotherKnack = \Mockery::mock(Knack::class);
        $anotherKnack->shouldReceive('getTypeName')
            ->andReturn('knack');

        $initialProperties->setInitialKnack($anotherKnack);
    }

    /**
     * @test
     * @depends person_can_be_set
     */
    public function maximal_initial_will_can_be_calculated()
    {
        $initialProperties = $this->getInitialProperties();
        /** @var \Mockery\MockInterface|Gender $gender */
        $gender = $initialProperties->getPerson()->getGender();
        /** @var \Mockery\MockInterface|Race $race */
        $race = $initialProperties->getPerson()->getRace();
        $race->shouldReceive('getWillModifier')
            ->with($gender)
            ->andReturn($genderWillModifier = 12345);

        $this->assertSame(
            3 /* maximal initial property increase (without race gender modifier) */ + $genderWillModifier,
            $initialProperties->calculateMaximalInitialWill()
        );
    }

    /**
     * @return InitialProperties
     *
     * @test
     * @depends maximal_initial_will_can_be_calculated
     */
    public function initial_will_can_be_set()
    {
        /** @var \Mockery\MockInterface|Will $will */
        $will = \Mockery::mock(Will::class);
        $will->shouldReceive('getTypeName')
            ->andReturn('will');
        $will->shouldReceive('getValue')
            ->andReturn($initialWillValue = 3 /* maximal initial will (without race gender modifier) */);

        $initialProperties = $this->getInitialProperties();

        /** @var \Mockery\MockInterface|Gender $gender */
        $gender = $initialProperties->getPerson()->getGender();
        /** @var \Mockery\MockInterface|Race $race */
        $race = $initialProperties->getPerson()->getRace();
        $race->shouldReceive('getWillModifier')
            ->with($gender)
            ->andReturn($genderWillModifier = 0);

        $initialProperties->setInitialWill($will);
        $this->assertSame($initialWillValue, $initialProperties->getInitialWill()->getValue());

        return $initialProperties;
    }

    /**
     * @test
     * @depends initial_will_can_be_set
     * @expectedException \DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties\Exceptions\InitialPropertyValueExceeded
     */
    public function too_high_initial_will_cause_exception()
    {
        /** @var \Mockery\MockInterface|Will $will */
        $will = \Mockery::mock(Will::class);
        $will->shouldReceive('getTypeName')
            ->andReturn('will');
        $will->shouldReceive('getValue')
            ->andReturn($initialWillValue = 4 /* higher than maximal initial will, including gender modifier for this case */);

        $initialProperties = $this->getInitialProperties();

        /** @var \Mockery\MockInterface|Gender $gender */
        $gender = $initialProperties->getPerson()->getGender();
        /** @var \Mockery\MockInterface|Race $race */
        $race = $initialProperties->getPerson()->getRace();
        $race->shouldReceive('getWillModifier')
            ->with($gender)
            ->andReturn($genderWillModifier = 0);

        $initialProperties->setInitialWill($will);
        $this->assertSame($initialWillValue, $initialProperties->getInitialWill()->getValue());
    }

    /**
     * @param InitialProperties $initialProperties
     *
     * @test
     * @depends initial_will_can_be_set
     * @expectedException \DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties\Exceptions\InitialPropertyIsAlreadySet
     */
    public function setting_another_initial_will_cause_exception(InitialProperties $initialProperties)
    {
        /** @var \Mockery\MockInterface|Will $anotherWill */
        $anotherWill = \Mockery::mock(Will::class);
        $anotherWill->shouldReceive('getTypeName')
            ->andReturn('will');

        $initialProperties->setInitialWill($anotherWill);
    }
    
    /**
     * @test
     * @depends person_can_be_set
     */
    public function maximal_initial_intelligence_can_be_calculated()
    {
        $initialProperties = $this->getInitialProperties();
        /** @var \Mockery\MockInterface|Gender $gender */
        $gender = $initialProperties->getPerson()->getGender();
        /** @var \Mockery\MockInterface|Race $race */
        $race = $initialProperties->getPerson()->getRace();
        $race->shouldReceive('getIntelligenceModifier')
            ->with($gender)
            ->andReturn($genderIntelligenceModifier = 12345);

        $this->assertSame(
            3 /* maximal initial property increase (without race gender modifier) */ + $genderIntelligenceModifier,
            $initialProperties->calculateMaximalInitialIntelligence()
        );
    }

    /**
     * @return InitialProperties
     *
     * @test
     * @depends maximal_initial_intelligence_can_be_calculated
     */
    public function initial_intelligence_can_be_set()
    {
        /** @var \Mockery\MockInterface|Intelligence $intelligence */
        $intelligence = \Mockery::mock(Intelligence::class);
        $intelligence->shouldReceive('getTypeName')
            ->andReturn('intelligence');
        $intelligence->shouldReceive('getValue')
            ->andReturn($initialIntelligenceValue = 3 /* maximal initial intelligence (without race gender modifier) */);

        $initialProperties = $this->getInitialProperties();

        /** @var \Mockery\MockInterface|Gender $gender */
        $gender = $initialProperties->getPerson()->getGender();
        /** @var \Mockery\MockInterface|Race $race */
        $race = $initialProperties->getPerson()->getRace();
        $race->shouldReceive('getIntelligenceModifier')
            ->with($gender)
            ->andReturn($genderIntelligenceModifier = 0);

        $initialProperties->setInitialIntelligence($intelligence);
        $this->assertSame($initialIntelligenceValue, $initialProperties->getInitialIntelligence()->getValue());

        return $initialProperties;
    }

    /**
     * @test
     * @depends initial_intelligence_can_be_set
     * @expectedException \DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties\Exceptions\InitialPropertyValueExceeded
     */
    public function too_high_initial_intelligence_cause_exception()
    {
        /** @var \Mockery\MockInterface|Intelligence $intelligence */
        $intelligence = \Mockery::mock(Intelligence::class);
        $intelligence->shouldReceive('getTypeName')
            ->andReturn('intelligence');
        $intelligence->shouldReceive('getValue')
            ->andReturn($initialIntelligenceValue = 4 /* higher than maximal initial intelligence, including gender modifier for this case */);

        $initialProperties = $this->getInitialProperties();

        /** @var \Mockery\MockInterface|Gender $gender */
        $gender = $initialProperties->getPerson()->getGender();
        /** @var \Mockery\MockInterface|Race $race */
        $race = $initialProperties->getPerson()->getRace();
        $race->shouldReceive('getIntelligenceModifier')
            ->with($gender)
            ->andReturn($genderIntelligenceModifier = 0);

        $initialProperties->setInitialIntelligence($intelligence);
        $this->assertSame($initialIntelligenceValue, $initialProperties->getInitialIntelligence()->getValue());
    }

    /**
     * @param InitialProperties $initialProperties
     *
     * @test
     * @depends initial_intelligence_can_be_set
     * @expectedException \DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties\Exceptions\InitialPropertyIsAlreadySet
     */
    public function setting_another_initial_intelligence_cause_exception(InitialProperties $initialProperties)
    {
        /** @var \Mockery\MockInterface|Intelligence $anotherIntelligence */
        $anotherIntelligence = \Mockery::mock(Intelligence::class);
        $anotherIntelligence->shouldReceive('getTypeName')
            ->andReturn('intelligence');

        $initialProperties->setInitialIntelligence($anotherIntelligence);
    }
    
    /**
     * @test
     * @depends person_can_be_set
     */
    public function maximal_initial_charisma_can_be_calculated()
    {
        $initialProperties = $this->getInitialProperties();
        /** @var \Mockery\MockInterface|Gender $gender */
        $gender = $initialProperties->getPerson()->getGender();
        /** @var \Mockery\MockInterface|Race $race */
        $race = $initialProperties->getPerson()->getRace();
        $race->shouldReceive('getCharismaModifier')
            ->with($gender)
            ->andReturn($genderCharismaModifier = 12345);

        $this->assertSame(
            3 /* maximal initial property increase (without race gender modifier) */ + $genderCharismaModifier,
            $initialProperties->calculateMaximalInitialCharisma()
        );
    }

    /**
     * @return InitialProperties
     *
     * @test
     * @depends maximal_initial_charisma_can_be_calculated
     */
    public function initial_charisma_can_be_set()
    {
        /** @var \Mockery\MockInterface|Charisma $charisma */
        $charisma = \Mockery::mock(Charisma::class);
        $charisma->shouldReceive('getTypeName')
            ->andReturn('charisma');
        $charisma->shouldReceive('getValue')
            ->andReturn($initialCharismaValue = 3 /* maximal initial charisma (without race gender modifier) */);

        $initialProperties = $this->getInitialProperties();

        /** @var \Mockery\MockInterface|Gender $gender */
        $gender = $initialProperties->getPerson()->getGender();
        /** @var \Mockery\MockInterface|Race $race */
        $race = $initialProperties->getPerson()->getRace();
        $race->shouldReceive('getCharismaModifier')
            ->with($gender)
            ->andReturn($genderCharismaModifier = 0);

        $initialProperties->setInitialCharisma($charisma);
        $this->assertSame($initialCharismaValue, $initialProperties->getInitialCharisma()->getValue());

        return $initialProperties;
    }

    /**
     * @test
     * @depends initial_charisma_can_be_set
     * @expectedException \DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties\Exceptions\InitialPropertyValueExceeded
     */
    public function too_high_initial_charisma_cause_exception()
    {
        /** @var \Mockery\MockInterface|Charisma $charisma */
        $charisma = \Mockery::mock(Charisma::class);
        $charisma->shouldReceive('getTypeName')
            ->andReturn('charisma');
        $charisma->shouldReceive('getValue')
            ->andReturn($initialCharismaValue = 4 /* higher than maximal initial charisma, including gender modifier for this case */);

        $initialProperties = $this->getInitialProperties();

        /** @var \Mockery\MockInterface|Gender $gender */
        $gender = $initialProperties->getPerson()->getGender();
        /** @var \Mockery\MockInterface|Race $race */
        $race = $initialProperties->getPerson()->getRace();
        $race->shouldReceive('getCharismaModifier')
            ->with($gender)
            ->andReturn($genderCharismaModifier = 0);

        $initialProperties->setInitialCharisma($charisma);
        $this->assertSame($initialCharismaValue, $initialProperties->getInitialCharisma()->getValue());
    }

    /**
     * @param InitialProperties $initialProperties
     *
     * @test
     * @depends initial_charisma_can_be_set
     * @expectedException \DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties\Exceptions\InitialPropertyIsAlreadySet
     */
    public function setting_another_initial_charisma_cause_exception(InitialProperties $initialProperties)
    {
        /** @var \Mockery\MockInterface|Charisma $anotherCharisma */
        $anotherCharisma = \Mockery::mock(Charisma::class);
        $anotherCharisma->shouldReceive('getTypeName')
            ->andReturn('charisma');

        $initialProperties->setInitialCharisma($anotherCharisma);
    }

}
