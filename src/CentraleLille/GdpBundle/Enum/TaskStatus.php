<?php

namespace CentraleLille\GdpBundle\Enum;

abstract class TaskStatus extends BasicEnum
{
    const PLANIFIE = "PLANIFIE";
    const EN_COURS = "EN_COURS";
    const TERMINE = "TERMINE";
    const ARCHIVE = "ARCHIVE";
}
