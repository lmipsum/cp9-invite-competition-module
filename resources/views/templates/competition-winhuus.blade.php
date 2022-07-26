@extends('layouts.winhuus')

@section('content')
    <competition dusk="competition" submit-route="{{ route('pageSubmits.store', $page) }}" correct-answer="1" v-cloak inline-template>
        <div>
            <div class="text-center" v-if="activePage === 'default'">


                <div class="text-center">
                    <div v-if="!contactFormSubmitted">
                        <h1 class="page-title text-uppercase">{{ $pageTexts['competition_title'] }}</h1>

                        {{ $pageTexts['competition_description'] }}

                        <h4 class="prize"><span>1. Preis</span> {{ $pageTexts['prize_1_title'] }}</h4>
                        <h4 class="prize"><span>2. Preis</span> {{ $pageTexts['prize_2_title'] }}</h4>
                        <h4 class="prize"><span>3. Preis</span> {{ $pageTexts['prize_3_title'] }}</h4>
                        <p class="small">{{ $pageTexts['prize_small_print'] }}</p>

                        <div v-if="!answerSubmitted" class="border-double">
                            <h2 class="text-uppercase" v-if="!answerSubmitted">{{ $pageTexts['competition_subline'] }}</h2>
                            <hr />

                            <h2 class="question">{{ $pageTexts['question'] }}</h2>

                            <div class="row">
                                <div class="col-sm-6 col-sm-offset-3 answer-container">
                                    <button class="btn btn-primary btn-block answer a" :class="{ selected: selectedAnswer == 1 }" @click="selectAnswer(1)">{{ $pageTexts['answer_1'] }}</button>
                                    <button class="btn btn-primary btn-block answer b" :class="{ selected: selectedAnswer == 2 }" @click="selectAnswer(2)">{{ $pageTexts['answer_2'] }}</button>
                                    <button class="btn btn-primary btn-block answer c" :class="{ selected: selectedAnswer == 3 }" @click="selectAnswer(3)">{{ $pageTexts['answer_3'] }}</button>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12">
                                    <button class="btn btn-success btn-lg text-uppercase" @click="submitAnswer()">Weiter</button>
                                </div>
                            </div>
                        </div>

                        <form action="#" class="form" method="POST" @submit.prevent="validateAndSubmitForm" v-if="answerSubmitted && correctAnswerSubmitted" novalidate>
                            <h2 class="text-uppercase">{{ $pageTexts['congrats_page_title'] }}</h2>
                            {{ $pageTexts['congrats_page_text'] }}

                            <h3>{{ $pageTexts['form_title'] }}</h3>
                            <div class="gender" :class="{'invalid': errors.has('gender') }">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="gender" id="gender" value="Frau" v-model="formData['gender']" v-validate="'required'" data-vv-as="Geschlecht" required>
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

                            <input id="first_name" name="first_name" v-model="formData['first_name']" type="text" class="form-control" value="" placeholder="Vorname*" v-validate="'min:2|required'" data-vv-as="Vorname" required>
                            <input id="name" name="name" v-model="formData['name']" type="text" class="form-control" value="" placeholder="Name*" v-validate="'min:2|required'" data-vv-as="Name" required>
                            <input id="email" name="email" v-model="formData['email']" type="email" class="form-control" value="" placeholder="E-Mail*" v-validate="'email|required'" data-vv-as="E-Mail" required>
                            <input id="phone" name="phone" v-model="formData['phone']" type="text" class="form-control" value="" placeholder="Telefonnummer*" v-validate="'required'" data-vv-as="Telefonnummer" required>
                            <input id="date" name="date" v-model="formData['date']" type="text" class="form-control" value="" placeholder="Geburtsdatum*" v-validate="'required'" data-vv-as="Geburtsdatum" required>

                            <div class="checkbox text-left">
                                <label :class="{'invalid': errors.has('terms') }">
                                    <input name="terms" type="checkbox" value="yes" v-model="formData['terms']" v-validate="'required'" data-vv-as="Teilnahmebedingungen" required>
                                    Hiermit akzeptiere ich die <a href="#" @click="setActivePage('terms')">Teilnahmebedinungen</a>*
                                </label>
                            </div>

                            <div class="checkbox text-left">
                                <label>
                                    <input type="checkbox" value="yes" v-model="formData['newsletter']">
                                    Gerne erhalte ich den Newsletter des Einkaufszentrum ShopVille
                                </label>
                            </div>

                            <div v-for="error in errors.all()" class="invalid" v-html="error"></div>

                            <button class="btn btn-success btn-submit text-uppercase">Senden</button>
                        </form>

                        <div v-if="answerSubmitted && !correctAnswerSubmitted">
                            <h2 class="text-uppercase">{{ $pageTexts['try_again_page_title'] }}</h2>
                            <p>{{ $pageTexts['try_again_page_text'] }}</p>
                            <button class="btn btn-default text-uppercase" @click="reloadPage()">Zurück</button>
                        </div>
                    </div>

                    <div v-if="contactFormSubmitted">
                        <h2 class="text-uppercase">{{ $pageTexts['final_page_title'] }}</h2>
                        <p>{!! nl2br($pageTexts['final_page_text']) !!}</p>
                    </div>
                </div>
            </div>

            <div class="text-center" v-if="activePage === 'terms'">
                <h1>Terms and conditions</h1>
                <button class="btn btn-default text-uppercase" @click="setActivePage('default')">Zurück</button>
            </div>
        </div>
    </competition>
@endsection
