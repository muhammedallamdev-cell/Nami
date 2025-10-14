@extends('admin.layouts.app')

@section('content')
  <div class="main-container">
      <!-- Logout Button (AJAX) -->
      <div class="d-flex justify-content-end p-3" style="background: #585e6b;">
        <form method="GET" action="{{ route('admin.auth.logout') }}">
          @csrf
          <button type="submit" class="btn btn-danger">
            <i class="bi bi-box-arrow-right"></i> Logout
          </button>
        </form>
      </div>

    <!-- Header -->
    <div class="header">
      <h1><i class="bi bi-briefcase-fill"></i> Nami Soft Project Dashboard</h1>
      <p>Manage and monitor your projects, employees, and time logs efficiently</p>
    </div>

    <!-- Controls Section -->
    <div class="controls-section">
      <div class="filter-card">
        <div class="row g-3 align-items-end">
          <div class="col-md-5">
            <label for="tableSelect" class="form-label">
              <i class="bi bi-funnel-fill"></i> Select View
            </label>
            <select id="tableSelect" class="form-select">
               <option disabled>-- Choose a View --</option>
               <option value="WorkTimes" selected>Work Times</option>
               <option value="Employees">Employees</option>
               <option value="Projects">Projects</option>
               <option value="Modules">Modules</option>
            </select>
          </div>

          <div class="col-md-3">
            <button id="applyBtn" class="btn btn-apply w-100">
              <i class="bi bi-check-circle-fill"></i> Apply Filter
            </button>
          </div>

          <div class="col-md-2">
            <button id="resetBtn" class="btn btn-reset w-100">
              <i class="bi bi-arrow-clockwise"></i> Reset
            </button>
          </div>
        </div>

        <div class="alert alert-info-custom mt-3 mb-0">
          <i class="bi bi-info-circle-fill"></i>
          <strong>Tip:</strong> Select a view from the dropdown and click "Apply Filter" to display specific data.
        </div>
      </div>
    </div>

    <!-- Content Section -->
    <div class="content-section">
      <div id="tablesContainer">

        <div id="noData" class="no-data" style="display: none;">
          <i class="bi bi-inbox"></i>
          <h4>No Data Selected</h4>
          <p>Please select a view from the dropdown above to display data.</p>
        </div>

      </div>
    </div>

    <!-- Footer -->
    <div class="footer">
      <p class="mb-0">
        <i class="bi bi-c-circle"></i> 2025 Nami Soft. All rights reserved. |
        <a href="#" class="text-decoration-none">Privacy Policy</a> |
        <a href="#" class="text-decoration-none">Terms of Service</a>
      </p>
    </div>
  </div>
@endsection