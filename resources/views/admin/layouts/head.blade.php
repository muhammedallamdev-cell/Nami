<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Nami Soft - Project Management Dashboard</title>

  <!-- CSRF for AJAX -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Bootstrap 5 CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    :root {
      --primary-color: #4f46e5;
      --secondary-color: #10b981;
      --accent-color: #f59e0b;
      --danger-color: #ef4444;
      --dark-color: #1f2937;
      --light-bg: #f9fafb;
    }

    body {
      background: #e9e9e9;
      min-height: 100vh;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .main-container {
      background: white;
      border-radius: 20px;
      box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
      margin: 2rem auto;
      max-width: 1400px;
      overflow: hidden;
    }

    .header {
      background: #585e6b;
      color: white;
      padding: 2rem;
      position: relative;
      overflow: hidden;
    }

    .header::before {
      content: '';
      position: absolute;
      top: -50%;
      right: -50%;
      width: 200%;
      height: 200%;
      background: radial-gradient(circle, rgba(255,255,255,0.1), transparent);
      animation: pulse 8s ease-in-out infinite;
    }

    @keyframes pulse {
      0%, 100% { transform: scale(1); opacity: 0.5; }
      50% { transform: scale(1.1); opacity: 0.8; }
    }

    .header h1 {
      font-size: 2.5rem;
      font-weight: 700;
      margin: 0;
      position: relative;
      z-index: 1;
    }

    .header p {
      margin: 0.5rem 0 0;
      opacity: 0.9;
      font-size: 1.1rem;
      position: relative;
      z-index: 1;
    }

    .controls-section {
      background: var(--light-bg);
      padding: 2rem;
      border-bottom: 1px solid #e5e7eb;
    }

    .filter-card {
      background: white;
      border-radius: 12px;
      padding: 1.5rem;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .form-label {
      font-weight: 600;
      color: var(--dark-color);
      margin-bottom: 0.5rem;
    }

    .form-select {
      border: 2px solid #e5e7eb;
      border-radius: 8px;
      padding: 0.75rem 1rem;
      transition: all 0.3s ease;
    }

    .form-select:focus {
      border-color: var(--primary-color);
      box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
    }

    .btn-apply {
      background: #5758db;
      border: none;
      padding: 0.75rem 2rem;
      font-weight: 600;
      border-radius: 8px;
      transition: all 0.3s ease;
      color: white;
    }

    .btn-reset {
      background: #6b7280;
      border: none;
      padding: 0.75rem 2rem;
      font-weight: 600;
      border-radius: 8px;
      color: white;
      transition: all 0.3s ease;
    }

    .btn-reset:hover {
      background: #4b5563;
      transform: translateY(-2px);
    }

    .content-section {
      padding: 2rem;
    }

    .table-card {
      background: white;
      border-radius: 15px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
      margin-bottom: 2rem;
      overflow: hidden;
      border: 1px solid #e5e7eb;
      transition: all 0.3s ease;
      display: none;
    }

    .table-card.active {
      display: block;
      animation: fadeIn 0.5s ease;
    }

    .card-header {
      background: #696b75;
      color: white;
      padding: 1.5rem;
      font-weight: 700;
      font-size: 1.2rem;
      border: none;
      display: flex;
      align-items: center;
      gap: 0.75rem;
    }

    .table {
      margin: 0;
    }

    .table thead th {
      background: var(--light-bg);
      color: var(--dark-color);
      font-weight: 700;
      text-transform: uppercase;
      font-size: 0.85rem;
      letter-spacing: 0.5px;
      border-bottom: 2px solid #e5e7eb;
      padding: 1rem;
    }

    .table tbody tr {
      transition: all 0.2s ease;
    }

    .table tbody td {
      padding: 1rem;
      vertical-align: middle;
      color: #4b5563;
    }

    .table-striped tbody tr:nth-of-type(odd) {
      background-color: #f9fafb;
    }

    .badge-custom {
      padding: 0.5rem 1rem;
      border-radius: 20px;
      font-weight: 600;
      font-size: 0.85rem;
    }

    .badge-employees {
      background: #dbeafe;
      color: #1e40af;
    }

    .badge-projects {
      background: #d1fae5;
      color: #065f46;
    }

    .badge-cost {
      background: #fef3c7;
      color: #92400e;
    }

    .stat-card {
      background: white;
      border-radius: 12px;
      padding: 1.5rem;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
      border-left: 4px solid var(--primary-color);
      margin-bottom: 1.5rem;
    }

    .stat-card h3 {
      font-size: 2rem;
      font-weight: 700;
      color: var(--primary-color);
      margin: 0;
    }

    .stat-card p {
      margin: 0.5rem 0 0;
      color: #6b7280;
      font-weight: 600;
    }

    .alert-info-custom {
      background: linear-gradient(135deg, #e0e7ff, #dbeafe);
      border: none;
      border-left: 4px solid var(--primary-color);
      border-radius: 12px;
      padding: 1rem 1.5rem;
      color: #1e40af;
    }

    .footer {
      background: var(--light-bg);
      padding: 1.5rem;
      text-align: center;
      border-top: 1px solid #e5e7eb;
    }

    .no-data {
      text-align: center;
      padding: 3rem;
      color: #9ca3af;
    }

    .no-data i {
      font-size: 4rem;
      margin-bottom: 1rem;
      opacity: 0.5;
    }

    @media (max-width: 768px) {
      .header h1 {
        font-size: 1.8rem;
      }

      .controls-section {
        padding: 1rem;
      }

      .content-section {
        padding: 1rem;
      }

      .main-container {
        margin: 1rem;
        border-radius: 15px;
      }
    }
  </style>
</head>
<body>