@extends ('generallayout')

@section('title', 'Dashboard')

@section('contents')
    <style>
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            padding: 2rem;
        }

        .dashboard-card {
            display: flex;
            flex-direction: column;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .dashboard-card:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .card-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            display: block;
        }

        .card-content {
            padding: 1rem;
            text-align: center;
        }

        .card-title {
            font-size: 1.5rem;
            color: #6a11cb;
            margin-bottom: 0.5rem;
        }

        .card-text {
            font-size: 1rem;
            color: #555;
            margin-bottom: 1rem;
            line-height: 1.5;
        }

        .card-link {
            display: inline-block;
            text-decoration: none;
            color: #2575fc;
            font-weight: bold;
            border: 2px solid #2575fc;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .card-link:hover {
            background-color: #2575fc;
            color: #fff;
        }
    </style>

    <div class="dashboard-grid">
        <div class="dashboard-card">
            <img src="{{ asset('image/analitecs.jpg') }}" alt="Analytics Image" class="card-image">
            <div class="card-content">
                <h2 class="card-title">Analytics</h2>
                <p class="card-text">Get a deep dive into your data trends and actionable insights.</p>
                <a href="#" class="card-link">View Analytics</a>
            </div>
        </div>

        <div class="dashboard-card">
            <img src="{{ asset('image/Prajeks.jpg') }}" alt="Projects Image" class="card-image">
            <div class="card-content">
                <h2 class="card-title">Projects</h2>
                <p class="card-text">Manage all your ongoing projects in one place and track progress.</p>
                <a href="#" class="card-link">Manage Projects</a>
            </div>
        </div>

        <div class="dashboard-card">
            <img src="{{ asset('image/Kulab.jpg') }}" alt="Team Collaboration Image" class="card-image">
            <div class="card-content">
                <h2 class="card-title">Team Collaboration</h2>
                <p class="card-text">Boost team productivity with our collaborative tools and features.</p>
                <a href="#" class="card-link">Collaborate Now</a>
            </div>
        </div>


    </div>
    </div>

@endsection