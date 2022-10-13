<?php

use MMWS\Model\Diet;

namespace MMWS\Response;

use MMWS\Model\Diet;
use MMWS\Model\Stats;

class DietWithStats extends Diet
{
    public Stats $stats;
}
