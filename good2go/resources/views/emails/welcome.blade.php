<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Good2Go</title>
</head>
<body style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif; line-height: 1.6; color: #1e293b; background-color: #f8fafc; margin: 0; padding: 0;">
    <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 0;">
        <!-- Header -->
        <div style="background: linear-gradient(135deg, #4F46E5 0%, #6366F1 100%); padding: 40px 20px; text-align: center;">
            <h1 style="color: #ffffff; margin: 0; font-size: 28px; font-weight: 700;">Welcome to Good2Go!</h1>
            <p style="color: #e0e7ff; margin: 10px 0 0 0; font-size: 16px;">Your trusted driver service</p>
        </div>

        <!-- Content -->
        <div style="padding: 30px 20px;">
            <p style="font-size: 18px; margin: 0 0 20px 0;">Hello {{ $user->name }},</p>
            
            <p style="font-size: 16px; margin: 0 0 20px 0;">
                Welcome to Good2Go! We're excited to have you on board. We provide premium car-and-driver and driver-only services 
                designed for busy professionals, families, and everyday travellers who value safety, convenience, and reliability.
            </p>

            <!-- Features -->
            <div style="background-color: #f1f5f9; border-radius: 8px; padding: 20px; margin: 20px 0;">
                <h2 style="font-size: 18px; font-weight: 600; margin: 0 0 15px 0; color: #1e293b;">What you can do:</h2>
                <ul style="margin: 0; padding-left: 20px; color: #475569;">
                    <li style="margin-bottom: 10px;">Book a professional driver for your car or a fully chauffeured vehicle</li>
                    <li style="margin-bottom: 10px;">Choose between hourly or daily hire options</li>
                    <li style="margin-bottom: 10px;">Track your bookings and manage your account online</li>
                    <li style="margin-bottom: 10px;">Enjoy safe, reliable, and professional service</li>
                </ul>
            </div>

            <!-- CTA -->
            <div style="text-align: center; margin: 30px 0;">
                <a href="{{ route('bookings.create') }}" style="display: inline-block; background-color: #4F46E5; color: #ffffff; padding: 12px 30px; text-decoration: none; border-radius: 25px; font-weight: 600; font-size: 16px;">
                    Book Your First Ride
                </a>
            </div>

            <p style="font-size: 16px; margin: 20px 0 0 0;">
                If you have any questions, our support team is here to help.
            </p>

            <p style="font-size: 16px; margin: 20px 0 0 0;">
                Best regards,<br>
                <strong>The Good2Go Team</strong>
            </p>
        </div>

        <!-- Footer -->
        <div style="background-color: #f8fafc; padding: 20px; text-align: center; border-top: 1px solid #e2e8f0;">
            <p style="font-size: 12px; color: #64748b; margin: 0 0 10px 0;">
                &copy; {{ date('Y') }} Good2Go. All rights reserved.
            </p>
            <p style="font-size: 12px; color: #64748b; margin: 0;">
                Safe. Reliable. Professional.
            </p>
        </div>
    </div>
</body>
</html>

