@extends ('generallayout')

@section('title', 'About Us')

@section('contents')

    <style>
        .about-content {
            background-color: #fff;
            border-radius: 8px;
            padding: 2rem;
            margin: 2rem auto;
            max-width: 800px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            line-height: 1.6;
            color: #555;
        }

        .about-content h1 {
            text-align: center;
            font-size: 2.5rem;
            color: #6a11cb;
            margin-bottom: 1rem;
        }

        .about-content h2 {
            text-align: center;
            font-size: 1.8rem;
            color: #2575fc;
            margin-top: 1.5rem;
        }

        .about-content img.about-image {
            max-width: 100%;
            border-radius: 8px;
            margin: 1.5rem 0;
        }

        .image-wrapper {
            display: inline-block;
            background-color: transparent;
            padding: 10px;
            /* Optional padding for better visual effect */
            transition: background-color 0.3s ease;
        }

        .image-wrapper:hover {
            background-color: green;
            /* Changes the background of the wrapper */
            border-radius: 8px;
            /* Optional rounded corners for smoother look */
        }

        .about-image {
            display: block;
            margin: 0 auto;
            width: 200px;
            height: 250px;
            border-radius: 12px;
            /* Optional for rounded corners */
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .about-image:hover {
            transform: scale(1.1);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            filter: brightness(1.1);
            border: 3px solid #6a11cb;
        }




        .team-section {
            text-align: center;
            padding: 2rem 1rem;
            background-color: #f9f9f9;
        }

        .team-section h2 {
            font-size: 2rem;
            color: #6a11cb;
            margin-bottom: 1rem;
        }

        .team-section p {
            font-size: 1rem;
            color: #555;
            margin-bottom: 2rem;
        }

        .team-members {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 2rem;
        }

        .team-member {
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            padding: 1rem;
            max-width: 250px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .team-member:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .team-image {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-bottom: 1rem;
            object-fit: cover;
            border: 3px solid #6a11cb;
        }

        .team-member h3 {
            font-size: 1.25rem;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .team-member p {
            font-size: 1rem;
            color: #777;
        }
    </style>

    <div class="about-content">
        <h1>Welcome to Our Story</h1>
        <p>We are passionate about delivering exceptional services and products to our clients. Our journey started with a
            mission to innovate and create lasting value in everything we do.</p>

        <img src="{{ asset('image/Sherks-removebg.png') }}" alt="About Us Image"
            style="width: 400px; display: block; margin: 0 auto;" class="about-image">

        <h2>Our Mission</h2>
        <p>To be a trusted partner, delivering excellence through innovative solutions and building long-term relationships
            with our clients.</p>

        <h2>Our Vision</h2>
        <p>To shape the future with sustainable and impactful solutions, inspiring trust and excellence in every endeavor.
        </p>

        <div class="team-section">
            <h2>Meet the Team</h2>
            <p>Our team is the backbone of our success. Together, we work towards achieving greatness and creating a
                positive impact in the community.</p>
            <div class="team-members">
                <div class="team-member">
                    <img src="{{asset('image/faceshrek.png')}}" alt="Team Member 1" class="team-image">
                    <h3>Shrek Daroya</h3>
                    <p>Founder & CEO</p>
                </div>
                <div class="team-member">
                    <img src="{{asset('image/shrek1.png')}}" alt="Team Member 2" class="team-image">
                    <h3>Shrek Dela Cruz</h3>
                    <p>Chief Operating Officer</p>
                </div>
                <div class="team-member">
                    <img src="{{asset('image/Shirks.png')}}" alt="Team Member 3" class="team-image">
                    <h3>Shrek Dimaguiba</h3>
                    <p>Head of Marketing</p>
                </div>
            </div>
        </div>

    </div>

@endsection