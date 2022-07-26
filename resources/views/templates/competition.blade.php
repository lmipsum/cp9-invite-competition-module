@extends('layouts.christkindli')

@section('content')
    <div class="text-center">
        <h1 class="page-title">Grosser Wettbewerb</h1>
        <h3 class="page-subtitle text-uppercase">Mitmachen & Gewinnen</h3>

        <h4 class="prize"><span>1. Preis</span> {{ $pageTexts['prize_1_title'] }}</h4>
        <h4 class="prize"><span>2. Preis</span> {{ $pageTexts['prize_2_title'] }}</h4>
        <h4 class="prize"><span>3. Preis</span> {{ $pageTexts['prize_3_title'] }}</h4>

        {{ $pageTexts['competition_description'] }}

        <h2 class="text-uppercase">{{ $pageTexts['competition_subline'] }}</h2>
        <hr />

        <competition dusk="competition" submit-route="{{ route('pageSubmits.store', $page) }}" correct-answer="1" v-cloak inline-template>
            <div>
                <div v-if="!contactFormSubmitted">
                    <div v-if="!answerSubmitted">
                        <h2 class="question">{{ $pageTexts['question'] }}</h2>

                        <div class="row">
                            <div class="col-sm-6 col-sm-offset-3">
                                <button class="btn btn-primary btn-block answer a" :class="{ selected: selectedAnswer == 1 }" @click="selectAnswer(1); submitAnswer()">{{ $pageTexts['answer_1'] }}</button>
                                <button class="btn btn-primary btn-block answer b" :class="{ selected: selectedAnswer == 2 }" @click="selectAnswer(2); submitAnswer()">{{ $pageTexts['answer_2'] }}</button>
                            </div>
                        </div>
                    </div>

                    <form action="#" class="form" method="POST" @submit.prevent="submitForm" v-if="answerSubmitted && correctAnswerSubmitted">
                        <h2>{{ $pageTexts['congrats_page_title'] }}</h2>
                        {{ $pageTexts['congrats_page_text'] }}

                        <h3 class="text-uppercase">Meine kontaktangaben</h3>
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

                        <input id="first_name" v-model="formData['first_name']" type="text" class="form-control" value="" placeholder="Vorname*" required>
                        <input id="name" v-model="formData['name']" type="text" class="form-control" value="" placeholder="Name*" required>
                        <input id="email" v-model="formData['email']" type="email" class="form-control" value="" placeholder="E-mail*" required>
                        <input id="date" v-model="formData['date']" type="text" class="form-control" value="" placeholder="Geburtsdatum*" required>

                        <div class="checkbox text-left">
                            <label>
                                <input type="checkbox" value="yes" v-model="formData['terms']" required>
                                Accept terms*
                            </label>
                        </div>

                        <div class="checkbox text-left">
                            <label>
                                <input type="checkbox" value="yes" v-model="formData['newsletter']">
                                Signup to newsletter
                            </label>
                        </div>

                        <button class="btn btn-success btn-submit text-uppercase">Senden</button>
                    </form>

                    <div v-if="answerSubmitted && !correctAnswerSubmitted">
                        <h2>{{ $pageTexts['try_again_page_title'] }}</h2>
                        {{ $pageTexts['try_again_page_text'] }}
                    </div>
                </div>

                <div v-if="contactFormSubmitted">
                    <h2>{{ $pageTexts['final_page_title'] }}</h2>
                    {{ $pageTexts['final_page_text'] }}
                </div>
            </div>
        </competition>
    </div>
@endsection
