<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills\Combined;

class PlayingOnMusicInstrument extends AbstractCombinedSkill
{
    const PLAYING_ON_MUSIC_INSTRUMENT = 'playing_on_music_instrument';

    /**
     * @return string
     */
    public function getName()
    {
        return self::PLAYING_ON_MUSIC_INSTRUMENT;
    }
}
