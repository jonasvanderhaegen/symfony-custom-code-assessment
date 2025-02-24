<?php

declare(strict_types=1);

namespace App\Restaurant\Domain\Staff\Service;

use App\Restaurant\Domain\Staff\Command\CreateShiftCommand;
use App\Restaurant\Domain\Staff\Model\ShiftId;
use App\Restaurant\Domain\Staff\Model\StaffId;
use App\Restaurant\Domain\Staff\Model\StaffingRequirements;
use DateTime;

interface StaffScheduler
{
    public function createShift(CreateShiftCommand $command): ShiftId;
    public function assignStaffToShift(ShiftId $shiftId, StaffId $staffId): void;
    public function calculateStaffingNeeds(DateTime $dateTime): StaffingRequirements;
} 