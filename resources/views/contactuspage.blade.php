@extends ('generallayout')

@section('title', 'Contact Us')

@section('contents')
    <style>
        .contact-section {
            max-width: 800px;
            margin: 2rem auto;
            padding: 2rem;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .contact-section h2 {
            font-size: 2.5rem;
            color: #6a11cb;
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .contact-section p {
            font-size: 1rem;
            color: #555555;
            text-align: center;
            margin-bottom: 2rem;
        }

        .contact-form {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        .form-group label {
            font-size: 0.9rem;
            color: #333333;
            margin-bottom: 0.5rem;
            display: block;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 0.75rem;
            font-size: 1rem;
            border: 1px solid #ccc;
            border-radius: 8px;
            outline: none;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            border-color: #6a11cb;
            box-shadow: 0 0 8px rgba(106, 17, 203, 0.2);
        }

        .form-group textarea {
            resize: none;
            height: 150px;
        }

        .contact-submit {
            padding: 0.75rem 2rem;
            font-size: 1rem;
            font-weight: bold;
            color: #ffffff;
            background-color: #6a11cb;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .contact-submit:hover {
            background-color: #2575fc;
        }

        .social-media {
            margin-top: 3rem;
            text-align: center;
        }

        .social-media h3 {
            font-size: 1.5rem;
            color: #6a11cb;
            margin-bottom: 1rem;
        }

        .social-icons {
            display: flex;
            justify-content: center;
            gap: 1.5rem;
        }

        .social-icons a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: #f1f1f1;
            overflow: hidden;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .social-icons a:hover {
            background-color: #6a11cb;
            transform: scale(1.1);
        }

        .social-icons img {
            width: 24px;
            height: 24px;
            object-fit: contain;
        }
    </style>

    <div class="contact-section">
        <h2>Contact Us</h2>
        <p>We'd love to hear from you! Fill out the form below or connect with us on social media.</p>
        <form class="contact-form">
            <div class="form-group">
                <label for="name">Your Name</label>
                <input type="text" id="name" name="name" placeholder="Enter your name" required>
            </div>
            <div class="form-group">
                <label for="email">Your Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <label for="message">Your Message</label>
                <textarea id="message" name="message" placeholder="Write your message here" required></textarea>
            </div>
            <button type="submit" class="contact-submit">Send Message</button>
        </form>

        <div class="social-media">
            <h3>Connect with us on our Social Media</h3>
            <div class="social-icons">
                <a href="https://facebook.com" target="_blank">
                    <img src="{{ asset('image/epbi.png') }}" alt="Facebook">
                </a>
                <a href="https://twitter.com" target="_blank">
                    <img src="{{ asset('image/twits.png') }}" alt="Twitter">
                </a>
                <a href="https://instagram.com" target="_blank">
                    <img src="{{ asset('image/ins.png') }}" alt="Instagram">
                </a>
                <a href="https://github.com" target="_blank">
                    <img src="{{ asset('image/gh.png') }}" alt="GitHub">
                </a>
                <a href="mailto:your-email@example.com">
                    <img src="{{ asset('image/gm.png') }}" alt="Gmail">
                </a>
            </div>
        </div>
    </div>
@endsection