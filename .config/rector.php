<?php

use RectorMoodle\Config\MoodleRectorConfig;
use RectorMoodle\Set\MoodleLevelSetList;

return MoodleRectorConfig::configure('/var/www/moodle')
    ->withSets([
        MoodleLevelSetList::UP_TO_MOODLE_45
    ])
    ->withImportNames();