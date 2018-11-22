@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pricing.css') }}">
@endpush
@section('jumbotron')
    @include('partials.jumbotron', [
    'title' => __("Suscribete a uno de nuestros planes"),
    'icon' => 'globe'
    ])
@endsection

@section('content')
    <div class="container-fluid">
        <div class="pricing-table pricing-three-column row">
            <div class="plan col-sm-3 col-lg-3">
                <div class="plan-name-bronze">
                    <h2>{{ __("FREE") }}</h2>
                    <span>{{ __(":price / Mes", ['price' => '$ 0.00']) }}</span>
                </div>
                <ul>
                    <li class="plan-feature">{{ __("Acceso a todos los cursos") }}</li>
                    <li class="plan-feature">{{ __("Acceso a todos los archivos") }}</li>
                    <li class="plan-feature">
                        @include('partials.stripe.form', [
                            "product" => [
                                "name" => __("Suscripcion"),
                                "description" => __("FREE"),
                                "type" => "free",
                                "amount" => 000,00
                            ]
                        ])
                    </li>
                </ul>
            </div>
            <div class="plan col-sm-3 col-lg-3">
                <div class="plan-name-bronze">
                    <h2>{{ __("MENSUAL") }}</h2>
                    <span>{{ __(":price / Mes", ['price' => '$ 9.99']) }}</span>
                </div>
                <ul>
                    <li class="plan-feature">{{ __("Acceso a todos los cursos") }}</li>
                    <li class="plan-feature">{{ __("Acceso a todos los archivos") }}</li>
                    <li class="plan-feature">
                        @include('partials.stripe.form', [
                            "product" => [
                                "name" => __("Suscripcion"),
                                "description" => __("Mensual"),
                                "type" => "monthly",
                                "amount" => 999,99
                            ]
                        ])
                    </li>
                </ul>
            </div>
            <div class="plan col-sm-3 col-lg-3">
                <div class="plan-name-silver">
                    <h2>{{ __("TRIMESTRAL") }}</h2>
                    <span>{{ __(":price / Mes", ['price' => '$ 19.99']) }}</span>
                </div>
                <ul>
                    <li class="plan-feature">{{ __("Acceso a todos los cursos") }}</li>
                    <li class="plan-feature">{{ __("Acceso a todos los archivos") }}</li>
                    <li class="plan-feature">
                        @include('partials.stripe.form', [
                            "product" => [
                                "name" => __("Suscripcion"),
                                "description" => __("Trimestral"),
                                "type" => "quarterly",
                                "amount" => 1999,99
                            ]
                        ])
                    </li>
                </ul>
            </div>
            <div class="plan col-sm-3 col-lg-3">
                <div class="plan-name-gold">
                    <h2>{{ __("ANUAL") }}</h2>
                    <span>{{ __(":price / Mes", ['price' => '$ 89.99']) }}</span>
                </div>
                <ul>
                    <li class="plan-feature">{{ __("Acceso a todos los cursos") }}</li>
                    <li class="plan-feature">{{ __("Acceso a todos los archivos") }}</li>
                    <li class="plan-feature">
                        @include('partials.stripe.form', [
                            "product" => [
                                "name" => __("Suscripcion"),
                                "description" => __("Anual"),
                                "type" => "yearly",
                                "amount" => 8999,99
                            ]
                        ])
                    </li>
                </ul>
            </div>
        </div>
    </div>

@endsection
