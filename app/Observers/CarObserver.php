<?php

namespace App\Observers;

use App\Models\Car;
use App\Traits\MainTrait;

class CarObserver
{
    use MainTrait;

    public function creating(Car $car)
    {
        $this->additions($car);
    }


    public function updating(Car $car)
    {
        $this->additions($car);
    }

    public function additions($car)
    {
        $car->safety_additions = (isset($car->safety_additions)) ? implode(",", $car->safety_additions) : null;
        $car->comfort_additions = (isset($car->comfort_additions)) ? implode(",", $car->comfort_additions) : null;
        $car->sound_additions = (isset($car->sound_additions)) ? implode(",", $car->sound_additions) : null;
        $car->user_id = $this->user_id();
    }


    /**
     * Handle the Car "created" event.
     */
    public function created(Car $car): void
    {
        //
    }

    /**
     * Handle the Car "updated" event.
     */
    public function updated(Car $car): void
    {
        //
    }

    /**
     * Handle the Car "deleted" event.
     */
    public function deleted(Car $car): void
    {
        //
    }

    /**
     * Handle the Car "restored" event.
     */
    public function restored(Car $car): void
    {
        //
    }

    /**
     * Handle the Car "force deleted" event.
     */
    public function forceDeleted(Car $car): void
    {
        //
    }
}
