# VGSS Student Grading Information System

**Venilale General Secondary School** - A complete web-based student grading management system built with CodeIgniter 4.

## Features

- User authentication (Admin & Teacher roles)
- Dashboard with statistics and quick actions
- Student management (add, edit, delete, view profiles)
- Subject management
- Class management
- Grade input and management with automatic GPA calculation
- Printable student report cards
- Class summary reports with rankings
- Search and filter functionality
- Responsive Bootstrap 5 interface

## System Requirements

- XAMPP (Apache + MySQL + PHP 8.3+)
- Composer
- Modern web browser

## Installation Instructions

### Step 1: Import Database

1. Open phpMyAdmin: `http://localhost/phpmyadmin`
2. Create a new database or import the SQL file:
   - Click "Import" tab
   - Choose file: `database/vgss_grading.sql`
   - Click "Go"

OR run this command in MySQL:
```bash
mysql -u root < database/vgss_grading.sql
```

### Step 2: Configure Database

The `.env` file is already configured for default XAMPP settings:
- Host: `localhost`
- Database: `vgss_grading`
- Username: `root`
- Password: `(empty)`

If your MySQL has a different password, edit `.env` and update `database.default.password`.

### Step 3: Access the System

Open your browser and navigate to:
```
http://localhost/nataliapi/public/
```

You will be redirected to the login page.

### Default Login Credentials

| Role | Username | Password |
|------|----------|----------|
| Admin | `admin` | `password` |
| Teacher | `teacher1` | `password` |

## Folder Structure

```
nataliapi/
├── app/
│   ├── Config/
│   │   ├── App.php          # Base URL and app settings
│   │   ├── Database.php     # Database config
│   │   ├── Filters.php      # Auth filter registration
│   │   └── Routes.php       # URL routing
│   ├── Controllers/
│   │   ├── Auth.php         # Login/logout
│   │   ├── Dashboard.php    # Dashboard
│   │   ├── Students.php     # Student CRUD
│   │   ├── Subjects.php     # Subject CRUD
│   │   ├── Classes.php      # Class CRUD
│   │   ├── Grades.php       # Grade management
│   │   └── Reports.php      # Report generation
│   ├── Filters/
│   │   └── AuthFilter.php   # Authentication middleware
│   ├── Models/
│   │   ├── UserModel.php    # User authentication
│   │   ├── StudentModel.php # Student operations
│   │   ├── SubjectModel.php # Subject operations
│   │   ├── ClassModel.php   # Class operations
│   │   └── GradeModel.php   # Grades + GPA calculation
│   └── Views/
│       ├── layouts/
│       │   └── main.php     # Main layout with sidebar
│       ├── auth/
│       │   └── login.php    # Login page
│       ├── dashboard/
│       │   └── index.php    # Dashboard
│       ├── students/        # Student CRUD views
│       ├── subjects/        # Subject CRUD views
│       ├── classes/         # Class CRUD views
│       ├── grades/          # Grade management views
│       └── reports/         # Report templates
├── database/
│   └── vgss_grading.sql     # Database schema + sample data
├── public/                  # Web root
└── .env                     # Environment config
```

## GPA Calculation

The system uses a 4.0 scale grading system:

| Score Range | Grade | Points |
|-------------|-------|--------|
| 90-100 | A+ | 4.0 |
| 85-89 | A | 4.0 |
| 80-84 | A- | 3.7 |
| 75-79 | B+ | 3.3 |
| 70-74 | B | 3.0 |
| 65-69 | B- | 2.7 |
| 60-64 | C+ | 2.3 |
| 55-59 | C | 2.0 |
| 50-54 | C- | 1.7 |
| 45-49 | D+ | 1.3 |
| 40-44 | D | 1.0 |
| 0-39 | F | 0.0 |

## Database Tables

- **users** - Admin and teacher accounts
- **students** - Student records with personal info
- **subjects** - Subject catalog
- **classes** - Class sections per academic year
- **grades** - Student grades with term/year tracking

## Test Cases (Black-box Testing)

### Authentication
| Test | Input | Expected Result |
|------|-------|-----------------|
| Login with valid admin | admin / password | Redirect to dashboard |
| Login with valid teacher | teacher1 / password | Redirect to dashboard |
| Login with wrong password | admin / wrong | Error message |
| Login with empty fields | (empty) / (empty) | Error message |
| Access protected page without login | Direct URL | Redirect to login |

### Student Management
| Test | Action | Expected Result |
|------|--------|-----------------|
| Add student with valid data | Fill form, submit | Success message, student listed |
| Add student with duplicate ID | Same student_id | Validation error |
| Edit student | Change name, save | Updated info displayed |
| Delete student | Click delete, confirm | Student removed |
| Search student | Enter name/ID | Filtered results |

### Grade Management
| Test | Action | Expected Result |
|------|--------|-----------------|
| Add grade with score 85 | Enter grade | Grade B, GPA 4.0 |
| Add grade with score 70 | Enter grade | Grade B, GPA 3.0 |
| Add grade with score 35 | Enter grade | Grade F, GPA 0.0 |
| Add grade > 100 | Enter 150 | Validation error |
| Duplicate grade | Same student+subject+term | Duplicate key error |

### Reports
| Test | Action | Expected Result |
|------|--------|-----------------|
| Student report | Select student | Report with all grades |
| Print report | Click print | Print dialog opens |
| Class report | Select class+term | Ranked student list |

## Sample Data Included

The SQL script includes:
- 2 users (1 admin, 1 teacher)
- 9 classes (Grade 7-12)
- 12 subjects
- 10 sample students
- 15 sample grades (Term 1, 2025-2026)
# teste1234
