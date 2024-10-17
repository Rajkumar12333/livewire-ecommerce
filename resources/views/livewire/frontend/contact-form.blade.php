<!-- Contact Form Begin -->
<div class="contact-form spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="contact__form__title">
                        <h2>Leave Message</h2>
                    </div>
                </div>
            </div>
            <form action="#">
            @if (session()->has('message'))
                <div class="alert alert-success" id="success-message" role="alert">
                    {{ session('message') }}
                </div>
            @endif

            <script>
                // Wait for the DOM to fully load
                document.addEventListener('DOMContentLoaded', function () {
                    // Get the success message element
                    const successMessage = document.getElementById('success-message');

                    // Check if the element exists
                    if (successMessage) {
                        // Set a timeout to hide the alert after 5 seconds (5000 milliseconds)
                        setTimeout(() => {
                            successMessage.style.display = 'none';
                        }, 1000); // Change 5000 to your desired time in milliseconds
                    }
                });
            </script>

                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <input type="text" wire:model="name" placeholder="Your name">
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <input type="text" wire:model="email"placeholder="Your Email">
                    </div>
                    <div class="col-lg-12 text-center">
                        <textarea wire:model="message" placeholder="Your message"></textarea>
                        <button type="button" wire:click="store" class="site-btn">SEND MESSAGE</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Contact Form End -->