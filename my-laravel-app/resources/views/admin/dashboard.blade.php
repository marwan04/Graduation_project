@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <section class="container mt-5">
        <div class="row">
            <!-- Check if the user is logged in -->
            @php
                $user = Auth::guard('instructor')->user();
            @endphp

            @if(!$user)
                <script> window.location.href = "/login"; </script>
            @endif

            <!-- Sidebar -->
            <div class="col-md-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body text-center">
                        <i class="bi bi-person-circle text-primary" style="font-size: 60px;"></i>
                        <h4 class="mt-2">{{ $user->name ?? 'Guest' }}</h4>
                        <p class="text-muted">Admin</p>
                        <hr>
                        <ul class="nav flex-column">
                            @if(Route::has('admin.courses.index'))
                               <li class="nav-item">
                                    <a class="nav-link text-primary fw-bold" href="{{ route('admin.courses.index') }}">📚 Manage Courses</a>
                               </li>
                            @endif
                            @if(Route::has('admin.sections.index'))
                                <li class="nav-item">
                                    <a class="nav-link text-primary fw-bold" href="{{ route('admin.sections.index') }}">📑 Manage Sections</a>
                                </li>
                            @endif
                            @if(Route::has('admin.roles.index'))
                                <li class="nav-item">
                                    <a class="nav-link text-primary fw-bold" href="{{ route('admin.roles.index') }}">🎭 Manage Roles</a>
                                </li>
                            @endif
                            @if(Route::has('admin.instructors.index'))
                                <li class="nav-item">
                                    <a class="nav-link text-primary fw-bold" href="{{ route('admin.instructors.index') }}">📋 Manage Instructors</a>
                                </li>
                            @endif
                            @if(Route::has('admin.students.index'))
                                <li class="nav-item">
                                    <a class="nav-link text-primary fw-bold" href="{{ route('admin.students.index') }}">🎓 Manage Students</a>
                                </li>
                            @endif
                            @if(Route::has('admin.plans.index'))
                                <li class="nav-item">
                                    <a class="nav-link text-primary fw-bold" href="{{ route('admin.plans.index') }}">📋 Manage Plans</a>
                                </li>
                            @endif
                            @if(Route::has('admin.enrollments.index'))
                                <li class="nav-item">
                                    <a class="nav-link text-primary fw-bold" href="{{ route('admin.enrollments.index') }}">📝 Manage Enrollments</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-md-9">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h2 class="fw-bold text-primary">⚙️ Admin Dashboard</h2>
                        <p>Welcome back, <strong>{{ $user->name ?? 'Guest' }}</strong>! Here’s an overview of the system.</p>
                        <hr>

                        <!-- Admin Statistics -->
                        <div class="row text-center">
                            @foreach ([['📚 Total Courses', 'text-primary', $courses_count ?? 0], 
                                      ['👨‍🏫 Total Instructors', 'text-info', $instructors_count ?? 0], 
                                      ['🎓 Total Students', 'text-success', $students_count ?? 0],
                                      ['📝 Total Enrollments', 'text-warning', $enrollments_count ?? 0]] 
                                      as [$title, $color, $count])
                            <div class="col-md-3">
                                <div class="card shadow-sm border-0 p-3">
                                    <h4 class="{{ $color }}">{{ $title }}</h4>
                                    <h3 class="fw-bold">{{ $count }}</h3>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <!-- Quick Access to Management Forms -->
                        <div class="mt-4">
                            <h4 class="fw-bold">🔗 Quick Access</h4>
                            <div class="d-flex flex-wrap">
                                @foreach ([
                                    'admin.courses.index' => 'Manage Courses', 
                                    'admin.sections.index' => 'Manage Sections', 
                                    'admin.roles.index' => 'Manage Roles',
                                    'admin.instructors.index' => 'Manage Instructors',
                                    'admin.students.index' => 'Manage Students',
                                    'admin.plans.index' => 'Manage Plans',
                                    'admin.enrollments.index' => 'Manage Enrollments'
                                ] as $route => $label)
                                    @if(Route::has($route))
                                        <a href="{{ route($route) }}" class="btn btn-outline-primary m-2">{{ $label }}</a>
                                    @endif
                                @endforeach
                            </div>
                        </div>

                        <!-- Courses Section -->
                        <div class="mt-4">
                            <h4 class="fw-bold">📚 Courses</h4>
                            <div class="row">
                                @forelse($courses as $course)
                                    <div class="col-md-4">
                                        <div class="card shadow-sm border-0">
                                            <div class="card-body">
                                                <h5 class="fw-bold">{{ $course->CourseName ?? 'N/A' }}</h5>
                                                <p class="text-muted">{{ $course->Semester ?? 'N/A' }}</p>
                                                <a href="{{ route('admin.courses.index') }}" class="btn btn-primary btn-sm">Manage Course</a>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-muted">No courses available.</p>
                                @endforelse
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

