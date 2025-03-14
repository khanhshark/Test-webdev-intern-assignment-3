@extends('layouts.App')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <!-- Card User Registration -->
            <div class="card shadow-sm mb-4 border-0"> 
                <div class="card-body">
                    <h2 class="fw-bold mb-3"><i class="bi bi-person-plus"></i> User Registration</h2>

                    <form action="{{ route('search') }}" method="GET" class="col-lg-4 col-md-6 col-12">
                        @csrf
                        <label for="registrationNumber" class="form-label fw-semibold">
                            <i class="bi bi-card-list"></i> Registration Number:
                        </label>
                        <div class="input-group">
                            <input type="text" name="registration_number" class="form-control @error('registration_number') is-invalid @enderror" 
                                id="registrationNumber" placeholder="Enter registration number" value="{{ old('registration_number') }}">
                            <button type="submit" class="btn btn-dark">
                                <i class="bi bi-search"></i> Search
                            </button>
                        </div>
                        @error('registration_number')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </form>
                </div>
            </div>

            <!-- Card Detailed Scores -->
            <div class="card shadow-sm w-100 border-0">
                <div class="card-body">
                    <h2 class="fw-bold"><i class="bi bi-clipboard-data"></i> Detailed Scores</h2>

                    @if(isset($student))
                        <div class="table-responsive">
                            <table class="table table-striped table-hover text-center align-middle border rounded">
                                <thead class="table-dark">
                                    <tr>
                                        <th><i class="bi bi-hash"></i> Reg. Number</th>
                                        <th><i class="bi bi-calculator"></i> Math</th>
                                        <th><i class="bi bi-book"></i> Literature</th>
                                        <th><i class="bi bi-globe"></i> Foreign Lang.</th>
                                        <th><i class="bi bi-lightning"></i> Physics</th>
                                        <th><i class="bi bi-flask"></i> Chemistry</th>
                                        <th><i class="bi bi-bug"></i> Biology</th>
                                        <th><i class="bi bi-clock-history"></i> History</th>
                                        <th><i class="bi bi-map"></i> Geography</th>
                                        <th><i class="bi bi-award"></i> Civic Edu.</th>
                                        <th><i class="bi bi-chat-text"></i> Lang. Code</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $student->registration_number }}</td>
                                        <td>{{ $student->math ?? '-' }}</td>
                                        <td>{{ $student->literature ?? '-' }}</td>
                                        <td>{{ $student->foreign_language ?? '-' }}</td>
                                        <td>{{ $student->physics ?? '-' }}</td>
                                        <td>{{ $student->chemistry ?? '-' }}</td>
                                        <td>{{ $student->biology ?? '-' }}</td>
                                        <td>{{ $student->history ?? '-' }}</td>
                                        <td>{{ $student->geography ?? '-' }}</td>
                                        <td>{{ $student->civic_education ?? '-' }}</td>
                                        <td>{{ $student->foreign_language_code ?? '-' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    @elseif(session('error'))
                    <p class="text-muted text-center">❌ No student found. Please enter a valid registration number.</p>
                    @else
                    <p class="text-primary fw-semibold">
                        <i class="bi bi-info-circle"></i> Detailed view of search scores here!
                    </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection