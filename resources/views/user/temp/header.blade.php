<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dark Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #1a202c; /* Dark background for the body */
            color: #e2e8f0; /* Light text color */
        }
        .navbar-dark {
            background-color: #2d3748 !important; /* Even darker shade for navbar */
            border-bottom: 1px solid #4a5568;
        }
        .sidebar {
            background-color: #2d3748; /* Dark background for sidebar */
            color: #e2e8f0;
            height: 100vh; /* Full height */
            position: fixed;
            top: 0;
            left: 0;
            width: 250px; /* Fixed width for sidebar */
            padding-top: 56px; /* Adjust for fixed navbar height */
            border-right: 1px solid #4a5568;
            overflow-y: auto; /* Enable scrolling for long content */
        }
        .sidebar .nav-link {
            color: #cbd5e0; /* Lighter text for links */
            padding: 15px 20px;
            display: flex;
            align-items: center;
            border-radius: 8px; /* Rounded corners for links */
            margin: 5px 10px;
            transition: all 0.2s ease-in-out; /* Smooth transition for hover */
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            background-color: #4a5568; /* Hover/active background */
            color: #ffffff; /* White text on hover/active */
        }
        .sidebar .nav-link i {
            margin-right: 10px;
            font-size: 1.1rem;
        }
        .main-content {
            margin-left: 250px; /* Offset for sidebar */
            padding: 20px;
            min-height: calc(100vh - 56px); /* Adjust for navbar */
        }
        .card {
            background-color: #2d3748; /* Dark card background */
            border: 1px solid #4a5568;
            border-radius: 12px; /* More rounded cards */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #4a5568; /* Darker header for cards */
            border-bottom: 1px solid #4a5568;
            color: #ffffff;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
            padding: 1rem 1.5rem; /* Add some padding to card header */
        }
        .card-body {
            padding: 1.5rem; /* Consistent padding for card body */
        }
        .btn-primary {
            background-color: #4299e1; /* Blue button */
            border-color: #4299e1;
            border-radius: 8px;
            transition: all 0.2s ease-in-out;
        }
        .btn-primary:hover {
            background-color: #3182ce;
            border-color: #3182ce;
        }
        .dropdown-menu {
            background-color: #2d3748; /* Dark dropdown */
            border: 1px solid #4a5568;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .dropdown-item {
            color: #e2e8f0;
            padding: 10px 20px;
            transition: all 0.2s ease-in-out;
        }
        .dropdown-item:hover {
            background-color: #4a5568;
            color: #ffffff;
            border-radius: 5px;
        }
        .list-group-item {
            background-color: transparent !important; /* Ensure transparent background for list items */
            color: #e2e8f0; /* Light text for list items */
            border-color: #4a5568; /* Border for list items */
        }
        .list-group-item:last-child {
            border-bottom-left-radius: 12px; /* Match card border radius */
            border-bottom-right-radius: 12px;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .sidebar {
                width: 0; /* Hide sidebar by default on small screens */
                overflow: hidden;
                transition: width 0.3s ease-in-out;
            }
            .sidebar.show {
                width: 250px; /* Show sidebar when toggled */
            }
            .main-content {
                margin-left: 0; /* No offset on small screens */
            }
            .navbar-toggler {
                display: block; /* Show toggler */
            }
        }
        @media (min-width: 769px) {
            .navbar-toggler {
                display: none; /* Hide toggler on larger screens */
            }
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark fixed-top shadow-sm">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand me-auto" href="#">Your Company Name</a>

            <div class="d-flex align-items-center">
                <a class="nav-link text-white me-3" href="#" aria-label="Notifications">
                    <i class="fas fa-bell fa-lg"></i>
                </a>
                <a class="nav-link text-white me-3" href="#" aria-label="Messages">
                    <i class="fas fa-envelope fa-lg"></i>
                </a>
                <div class="dropdown">
                    <a class="nav-link text-white dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset('storage/' . Auth::user()->profile )}}" alt="Profile" class="rounded-circle me-1" style="width: 40px; height: 40px; object-fit: cover;">
                        {{Auth::user()->name}}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                        <li><a class="dropdown-item" href="#"><i class="fas fa-user-circle me-2"></i>Profile</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                                <!-- Logout link -->
                         <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                         <i class="fas fa-sign-out-alt me-2"></i> Logout
                            </a>

                         <!-- Hidden logout form -->
                         <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                         </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>