@extends('layouts.header')

@section('banner')
    <div class="hero-banner">
        <i class="fas fa-envelope diamond-icon diamond-1"></i>
        <i class="fas fa-phone diamond-icon diamond-2"></i>
        <i class="fas fa-map-marker-alt diamond-icon diamond-3"></i>

        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto text-center text-white">
                    <h1 class="display-3 fw-bold mb-3">📧 Get In Touch 📧</h1>
                    <p class="lead mb-4">We'd Love to Hear From You - Contact Us Today</p>
                    <div class="badges d-flex justify-content-center gap-3 flex-wrap">
                        <span class="badge"><i class="fas fa-clock me-2"></i>24/7 Support</span>
                        <span class="badge"><i class="fas fa-headset me-2"></i>Expert Assistance</span>
                        <span class="badge"><i class="fas fa-reply me-2"></i>Quick Response</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <h1 class="text-center mb-4">Contact Us</h1>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form>
                <div class="mb-3">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" id="name" class="form-control" placeholder="Your full name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" id="email" class="form-control" placeholder="name@example.com" required>
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Your Message</label>
                    <textarea id="message" rows="5" class="form-control" placeholder="Write your message here..."
                        required></textarea>
                </div>
                <button type="submit" class="btn btn-primary w-100">Send Message</button>
            </form>
        </div>
    </div>
    <br>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="row g-4">
                <!-- Phone -->
                <div class="col-md-4">
                    <div class="text-center p-4">
                        <div class="mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor"
                                class="bi bi-telephone text-primary" viewBox="0 0 16 16">
                                <path
                                    d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z" />
                            </svg>
                        </div>
                        <h5>Phone</h5>
                        <p class="mb-0">+92 300 1234567</p>
                    </div>
                </div>

                <!-- Email -->
                <div class="col-md-4">
                    <div class="text-center p-4">
                        <div class="mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor"
                                class="bi bi-envelope text-primary" viewBox="0 0 16 16">
                                <path
                                    d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z" />
                            </svg>
                        </div>
                        <h5>Email</h5>
                        <p class="mb-0">info@yourcompany.com</p>
                    </div>
                </div>

                <!-- Address -->
                <div class="col-md-4">
                    <div class="text-center p-4">
                        <div class="mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor"
                                class="bi bi-geo-alt text-primary" viewBox="0 0 16 16">
                                <path
                                    d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A31.493 31.493 0 0 1 8 14.58a31.481 31.481 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z" />
                                <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                            </svg>
                        </div>
                        <h5>Address</h5>
                        <p class="mb-0">123 Main Street<br>Karachi, Pakistan</p>
                    </div>
                </div>
            </div>

            <!-- Optional: Additional Information Section -->
            <div class="mt-5 p-4 bg-light rounded">
                <h4 class="mb-3">Get in Touch</h4>
                <p>Have questions or need assistance? Feel free to reach out to us through any of the contact methods above.
                    We're here to help!</p>
                <p class="mb-0"><strong>Business Hours:</strong> Monday - Friday, 9:00 AM - 6:00 PM (PKT)</p>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('styles')
    <style>
        /* Responsive Contact Page Styles */

        /* Tablet (768px and below) */
        @media (max-width: 768px) {
            .hero-banner .display-3 {
                font-size: 2rem;
            }

            .hero-banner {
                padding: 50px 0;
            }

            .diamond-icon {
                font-size: 60px !important;
                opacity: 0.15;
            }

            /* Adjust diamond positions to not interfere with text */
            .diamond-1 {
                top: 5%;
                left: 5%;
            }

            .diamond-2 {
                top: 80%;
                right: 10%;
            }

            .diamond-3 {
                display: none;
            }

            /* Hide one diamond on smaller screens */

            h1.text-center {
                font-size: 2rem;
            }

            .badge {
                font-size: 0.8rem !important;
                padding: 8px 16px !important;
            }
        }

        /* Mobile (576px and below) */
        @media (max-width: 576px) {
            .hero-banner .display-3 {
                font-size: 1.5rem;
            }

            .display-3 {
                font-size: 1.8rem;
                /* Fallback */
            }

            .hero-banner .lead {
                font-size: 1rem;
            }

            /* Stack badges vertically or tighter grid */
            .badges {
                flex-direction: column;
                align-items: center;
                gap: 10px !important;
            }

            .badge {
                width: 100%;
                max-width: 250px;
                text-align: center;
            }

            /* Form Controls */
            .form-control {
                font-size: 16px;
                /* Prevent zoom on iOS */
                padding: 12px;
            }

            .btn-primary {
                width: 100%;
                padding: 12px;
            }

            /* Contact Info Cards */
            .col-md-4 {
                margin-bottom: 1rem;
            }

            .p-4 {
                padding: 1.5rem !important;
            }
        }
    </style>
@endsection