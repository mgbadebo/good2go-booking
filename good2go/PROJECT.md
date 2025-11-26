# Good2Go - Car & Driver Booking Platform

## Project Overview

Good2Go is a Laravel-based booking platform for car and driver services. The platform allows users to book professional drivers for hourly or daily hire, either with a chauffeured vehicle or for their own car.

## Technology Stack

- **Framework**: Laravel 12.39.0
- **PHP Version**: 8.4.14
- **Database**: MySQL
- **Frontend**: 
  - Tailwind CSS 3.1.0
  - Alpine.js 3.4.2
  - Vite 7.0.7
- **Email Service**: Brevo (formerly Sendinblue)
- **Authentication**: Laravel Breeze (Blade stack)

## Core Features

### 1. User Management
- User registration with phone number (required) and email (optional)
- Phone-based authentication system
- User status management (active, inactive, banned)
- Admin role system (`is_admin` boolean flag)
- Phone verification system (infrastructure in place)

### 2. Service Types
- **Car + Driver**: Chauffeured car with professional driver
- **Driver Only**: Professional driver for customer's own vehicle
- Service type management with active/inactive status
- Slug-based routing for services

### 3. Pricing System
- Flexible pricing rules per service type
- **Hourly Hire**: Minimum hours, base rate per hour
- **Daily Hire**: Fixed daily rate with specified hours
- Currency support (default: NGN - Nigerian Naira)
- Night surcharge support (none, percent, flat)
- Active/inactive pricing rules

### 4. Booking System
- Online booking creation (authenticated users only)
- Booking status workflow:
  - Pending → Confirmed → In Progress → Completed
  - Cancelled status available
- Payment status tracking:
  - Pending → Paid → Failed → Cancelled → Refunded
- Payment methods:
  - Bank Transfer (implemented)
  - Paystack (infrastructure ready)
- Automatic pricing calculation based on service type and hire duration
- Pickup and dropoff location tracking
- Admin notes and customer notes support

### 5. Driver Management
- Driver profiles with vehicle information
- Driver status (available, on_trip, unavailable)
- Driver approval system
- Driver applications system
- License and vehicle details tracking

### 6. Availability Management
- Working hours configuration (per day of week)
- Blackout dates system
- Service-specific availability rules
- Driver-specific availability (infrastructure ready)

### 7. Payment System
- Payment records linked to bookings
- Multiple payment providers support
- Payment status tracking
- Provider reference storage (Paystack ref, bank ref)
- Payment metadata storage (JSON)

### 8. Email Integration (Brevo)
- **Booking Confirmation**: Sent when booking is created
- **Booking Status Update**: Sent when booking status changes
- **Booking Reminder**: Scheduled reminders 24 hours before booking
- **Welcome Email**: Sent to new users upon registration
- **Contact Form Submission**: Emails sent to info@good2go.ng
- Both SMTP and API methods supported
- BrevoService class for advanced API features

### 9. Admin Panel
- Role-based access control (admin middleware)
- Dashboard with statistics:
  - Total bookings
  - Total revenue
  - Revenue this month
  - Upcoming bookings
  - Bookings by status
- Booking management:
  - Filter by date, status, payment status
  - Search functionality
  - Status updates with email notifications
  - Payment status updates
- Service type management (CRUD)
- Pricing rule management (CRUD)
- Availability management:
  - Working hours configuration
  - Blackout dates management
- Driver management:
  - Driver CRUD operations
  - Driver application review
  - Approve/reject applications
- Content management:
  - About Us content
  - Contact information
  - Bank transfer details
- User management:
  - User listing with filters
  - User status management
  - Admin role toggling

### 10. Public Pages
- **Home Page**: Hero section, service overview, quick snapshot, why choose Good2Go
- **Services Page**: Display of available service types
- **Pricing Page**: Hourly and daily pricing for both service types
- **FAQs Page**: Frequently asked questions (dynamic from database)
- **Contact Page**: 
  - Contact form with validation
  - WhatsApp click-to-chat button
  - Contact information display
  - Thank you message modal
- **Driver Recruitment Page**: Application form for driver applicants
- **About Page**: About us content

### 11. Contact System
- Contact form with validation
- Messages stored in database
- Email notifications to info@good2go.ng
- Status tracking (new, read, replied)
- WhatsApp integration (+234 803 846 4849)
- Phone: +234 803 846 4849
- Email: info@good2go.ng

## Database Schema

### Core Tables
- `users`: User accounts with phone-based authentication
- `service_types`: Available service types (Car + Driver, Driver Only)
- `pricing_rules`: Pricing configuration per service type
- `bookings`: Customer bookings
- `payments`: Payment records
- `drivers`: Driver profiles
- `driver_applications`: Driver application submissions

### Supporting Tables
- `phone_verifications`: Phone verification codes
- `availability_rules`: Working hours and availability
- `blackout_dates`: Service blackout dates
- `contact_messages`: Contact form submissions
- `faqs`: Frequently asked questions
- `testimonials`: Customer testimonials
- `site_settings`: Site configuration (key-value store)

## Email Templates

All email templates use Markdown format:
- `emails/booking-confirmation.blade.php`
- `emails/booking-status-update.blade.php`
- `emails/booking-reminder.blade.php`
- `emails/welcome.blade.php`
- `emails/contact-form-submitted.blade.php`

## Scheduled Commands

- `app:send-booking-reminders`: Sends reminder emails 24 hours before bookings
  - Command: `php artisan app:send-booking-reminders`
  - Recommended: Run daily via cron or Laravel scheduler

## UI/UX Features

### Responsive Design
- Mobile-first approach
- Hamburger menu for mobile navigation
- Responsive grid layouts
- Touch-friendly buttons and forms

### Safari Compatibility
- Safari-specific CSS fixes
- Backdrop-blur support with webkit prefix
- Fallback CSS loading for production
- Logo sizing fixes

### Branding
- Custom Good2Go logo
- Favicon support (16x16, 32x32, and standard)
- Consistent color scheme (Indigo primary)
- Modern, clean design

## Security Features

- CSRF protection on all forms
- Authentication middleware
- Admin role-based access control
- Input validation on all forms
- SQL injection protection (Eloquent ORM)
- XSS protection (Blade templating)

## File Structure

```
good2go/
├── app/
│   ├── Console/Commands/
│   │   └── SendBookingReminders.php
│   ├── Http/Controllers/
│   │   ├── Admin/ (Admin controllers)
│   │   ├── Auth/ (Authentication controllers)
│   │   ├── BookingController.php
│   │   ├── ContactController.php
│   │   ├── HomeController.php
│   │   ├── PageController.php
│   │   └── ServiceController.php
│   ├── Mail/ (Mailable classes)
│   ├── Models/ (Eloquent models)
│   ├── Services/
│   │   └── BrevoService.php
│   └── Providers/
│       └── AppServiceProvider.php
├── database/
│   ├── migrations/ (Database migrations)
│   └── seeders/ (Database seeders)
├── public/
│   ├── build/ (Compiled assets)
│   ├── images/
│   │   ├── hero/
│   │   ├── logo/
│   │   └── services/
│   └── favicon files
├── resources/
│   ├── css/
│   │   └── app.css
│   ├── js/
│   │   └── app.js
│   └── views/
│       ├── admin/ (Admin panel views)
│       ├── auth/ (Login/Register views)
│       ├── bookings/
│       ├── emails/ (Email templates)
│       ├── home/
│       ├── layouts/
│       ├── pages/
│       └── services/
└── routes/
    └── web.php
```

## Configuration Files

- `.env`: Environment configuration
- `config/mail.php`: Mail configuration (Brevo SMTP)
- `config/services.php`: Third-party services (Brevo API)
- `tailwind.config.js`: Tailwind CSS configuration
- `vite.config.js`: Vite build configuration

## Deployment Checklist

### Initial Setup
1. Clone repository
2. Run `composer install --no-dev --optimize-autoloader`
3. Run `npm install && npm run build`
4. Copy `.env.example` to `.env`
5. Configure database connection
6. Configure Brevo credentials
7. Run `php artisan key:generate`
8. Run `php artisan migrate`
9. Run `php artisan db:seed`
10. Set proper file permissions

### After Code Updates
1. `git pull origin main`
2. `composer install --no-dev --optimize-autoloader`
3. `npm install && npm run build` (if assets changed)
4. `php artisan migrate` (if migrations exist)
5. `php artisan config:clear`
6. `php artisan cache:clear`
7. `php artisan route:clear`
8. `php artisan view:clear`
9. `php artisan config:cache` (production)
10. `php artisan route:cache` (production)
11. `php artisan view:cache` (production)

## Environment Variables

### Required
- `APP_NAME`: Application name
- `APP_ENV`: Environment (local, production)
- `APP_KEY`: Application encryption key
- `DB_CONNECTION`: Database driver (mysql)
- `DB_HOST`: Database host
- `DB_DATABASE`: Database name
- `DB_USERNAME`: Database username
- `DB_PASSWORD`: Database password

### Brevo Configuration
- `MAIL_MAILER`: Set to `brevo`
- `MAIL_FROM_ADDRESS`: Sender email address
- `MAIL_FROM_NAME`: Sender name
- `BREVO_API_KEY`: Brevo API key (optional, for API method)
- `BREVO_SMTP_HOST`: Brevo SMTP host
- `BREVO_SMTP_PORT`: Brevo SMTP port (587)
- `BREVO_SMTP_USERNAME`: Brevo SMTP username
- `BREVO_SMTP_PASSWORD`: Brevo SMTP password
- `BREVO_SMTP_ENCRYPTION`: TLS or SSL

## Known Limitations / Future Enhancements

### Current Limitations
- Paystack integration not yet implemented (infrastructure ready)
- Phone verification SMS not yet implemented (infrastructure ready)
- Real-time availability checking not fully implemented
- Driver assignment automation not implemented
- Booking calendar view not available
- Customer reviews/ratings not implemented

### Planned Enhancements
- Paystack payment gateway integration
- SMS verification via Brevo or Twilio
- Real-time booking availability checking
- Automated driver assignment
- Booking calendar interface
- Customer review and rating system
- Push notifications
- Mobile app (future consideration)

## Documentation Files

- `README.md`: Project setup instructions
- `BREVO_SETUP.md`: Brevo email integration guide
- `BREVO_API_USAGE.md`: Brevo API usage guide
- `PROJECT.md`: This file - product documentation

## Contact Information

- **Phone**: +234 803 846 4849
- **Email**: info@good2go.ng
- **WhatsApp**: +234 803 846 4849

## Version History

### Version 1.0 (Current)
- Initial release
- Core booking functionality
- Admin panel
- Email integration
- Contact form
- Mobile-responsive design
- Safari compatibility fixes

---

**Last Updated**: November 25, 2024
**Maintained By**: Development Team

