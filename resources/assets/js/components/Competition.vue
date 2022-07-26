<script>
    import VeeValidate from 'vee-validate';

    export default {
        props: ['submitRoute', 'correctAnswer'],
        data() {
            return {
                activePage: 'default',
                selectedAnswer: null,
                answerSubmitted: false,
                correctAnswerSubmitted: false,
                contactFormSubmitted: false,
                formData: {},
            }
        },
        methods: {
            selectAnswer: function (answer) {
                this.selectedAnswer = answer;
            },
            submitAnswer: function () {
                this.answerSubmitted = true;
                this.correctAnswerSubmitted = parseInt(this.selectedAnswer) === parseInt(this.correctAnswer);
            },
            submitForm: function () {
                // @TODO: add google invisible captcha

                axios.post(this.submitRoute, {
                    'formData': JSON.parse(JSON.stringify(this.formData)),
                })
                .then(response => {
                    this.contactFormSubmitted = true;
                })
                .catch(error => {
                    console.log(error);
                    alert('There was an error while submitting your response. Please reload the page and try again!')
                });
            },
            validateAndSubmitForm() {
                this.$validator.validateAll().then((passed) => {
                    if (passed) {
                        this.submitForm();
                    }
                });
            },
            setActivePage: function (page) {
                this.activePage = page;
            },
            reloadPage: function () {
                top.location.reload();
            }
        },
    }
</script>