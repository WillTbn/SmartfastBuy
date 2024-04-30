<?php

namespace App\Providers;

use App\Events\Responsible\SetResponsibleCondominia;
use App\Events\Responsible\SetSignatureResponsible;
use App\Events\Signature\SetSignatureContract;
use Illuminate\Auth\Events\Registered;
use App\Listeners\Contract\SendEmailContractToCeo;
use App\Listeners\Contract\SendEmailSignatureResponsible;
use App\Listeners\Contract\SetSignatureCeoTable;
use App\Listeners\Contract\SetSignatureResponsibleTable;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use App\Listeners\SendEmailResponsable;
use App\Models\Apartment;
use App\Models\Condominia;
use App\Models\ContractCondominia;
use App\Models\Product;
use App\Observers\ApartmentObserver;
use App\Observers\CondominiaObserver;
use App\Observers\ContractCondominiaObserver;
use App\Observers\ProductObserver;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        SetResponsibleCondominia::class =>[
            SendEmailResponsable::class
        ],
        SetSignatureResponsible::class =>[
            SetSignatureResponsibleTable::class,
            SendEmailSignatureResponsible::class
        ],
        SetSignatureContract::class => [
            SetSignatureCeoTable::class,
            SendEmailContractToCeo::class
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {

        Apartment::observe(ApartmentObserver::class);
        Product::observe(ProductObserver::class);
        Condominia::observe(CondominiaObserver::class);
        ContractCondominia::observe(ContractCondominiaObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
