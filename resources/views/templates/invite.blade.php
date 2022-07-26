@extends('layouts.christkindli')

@section('content')
    <invite dusk="invite" submit-route="{{ route('pageSubmits.store', $page) }}" v-cloak inline-template>
        <div class="text-center">
            <h1 class="page-title">Einladung zum Event</h1>
            <h3 class="page-subtitle text-uppercase">Anmeldung</h3>

            <div v-if="!submitted">
                <p>
                    {{ $pageTexts['event_description'] }}
                </p>

                <h2 class="text-uppercase">{{ $pageTexts['contact_form_title'] }}</h2>
                <hr />

                <form action="#" class="form" method="POST" @submit.prevent="submitForm">
                    <div class="feedback">
                        <div class="radio">
                            <label>
                                <input type="radio" name="coming" id="coming" v-bind:value="1" v-model="formData['coming']" required>
                                {{ $pageTexts['feedback_option_1'] }}
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="coming" id="coming" v-bind:value="0" v-model="formData['coming']" required>
                                {{ $pageTexts['feedback_option_2'] }}
                            </label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="text-uppercase">Meine<br/>kontaktangaben</h3>
                            <div class="gender">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="gender" id="gender" value="Frau" v-model="formData['gender']" required>
                                        Frau
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="gender" id="gender" value="Herr" v-model="formData['gender']" required>
                                        Herr
                                    </label>
                                </div>
                            </div>

                            <input id="company" v-model="formData['company']" type="text" class="form-control" value="" placeholder="Firma*" required>
                            <input id="first_name" v-model="formData['first_name']" type="text" class="form-control" value="" placeholder="Vorname*" required>
                            <input id="name" v-model="formData['name']" type="text" class="form-control" value="" placeholder="Name*" required>
                            <input id="email" v-model="formData['email']" type="email" class="form-control" value="" placeholder="E-mail*" required>
                        </div>

                        <div class="col-sm-6">
                            <h3 class="text-uppercase">Meine<br/>begleitperson</h3>
                            <div class="gender">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="gender_2" id="gender_2" value="Frau" v-model="formData['gender_2']" required>
                                        Frau
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="gender_2" id="gender_2" value="Herr" v-model="formData['gender_2']" required>
                                        Herr
                                    </label>
                                </div>
                            </div>

                            <input id="company_2" v-model="formData['company_2']" type="text" class="form-control" value="" placeholder="Firma*" required>
                            <input id="first_name_2" v-model="formData['first_name_2']" type="text" class="form-control" value="" placeholder="Vorname*" required>
                            <input id="name_2" v-model="formData['name_2']" type="text" class="form-control" value="" placeholder="Name*" required>
                            <input id="email_2" v-model="formData['email_2']" type="email" class="form-control" value="" placeholder="E-mail*" required>
                        </div>
                    </div>

                    <button class="btn btn-success btn-submit text-uppercase">Senden</button>
                </form>
            </div>

            <div v-if="submitted">
                <div v-if="formData['coming']">
                    <h2>{{ $pageTexts['thanks_page_title'] }}</h2>
                    {{ $pageTexts['thanks_page_text'] }}
                </div>

                <div v-if="!formData['coming']">
                    <h2>{{ $pageTexts['pity_page_title'] }}</h2>
                    {{ $pageTexts['pity_page_text'] }}
                </div>

                <a href="#" class="btn btn-primary btn-finished text-uppercase">Bis bald</a>
            </div>
        </div>
    </invite>
@endsection
