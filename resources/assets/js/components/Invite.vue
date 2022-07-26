<script>
    export default {
        props: ['submitRoute'],
        data() {
            return {
                submitted: false,
                formData: {
                    coming: 1,
                },
            }
        },
        methods: {
            submitForm: function () {
                // @TODO: add google invisible captcha
                axios.post(this.submitRoute, {
                    'formData': JSON.parse(JSON.stringify(this.formData)),
                })
                .then(response => {
                    this.submitted = true;
                })
                .catch(error => {
                    console.log(error);
                    alert('There was an error while submitting your response. Please reload the page and try again!')
                });
            }
        },
    }
</script>