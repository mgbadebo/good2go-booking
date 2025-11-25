<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Reminder</title>
</head>
<body style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif; line-height: 1.6; color: #1e293b; background-color: #f8fafc; margin: 0; padding: 0;">
    <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 0;">
        <!-- Header -->
        <div style="background: linear-gradient(135deg, #4F46E5 0%, #6366F1 100%); padding: 30px 20px; text-align: center;">
            <h1 style="color: #ffffff; margin: 0; font-size: 24px; font-weight: 700;">Good2Go</h1>
            <p style="color: #e0e7ff; margin: 5px 0 0 0; font-size: 14px;">Booking Reminder</p>
        </div>

        <!-- Content -->
        <div style="padding: 30px 20px;">
            <p style="font-size: 16px; margin: 0 0 20px 0;">Hello {{ $user->name }},</p>
            
            <p style="font-size: 16px; margin: 0 0 20px 0;">
                This is a friendly reminder that you have a booking scheduled for <strong>{{ $booking->start_datetime->format('l, F j, Y') }}</strong>.
            </p>

            <!-- Booking Details -->
            <div style="background-color: #f1f5f9; border-radius: 8px; padding: 20px; margin: 20px 0;">
                <h2 style="font-size: 18px; font-weight: 600; margin: 0 0 15px 0; color: #1e293b;">Your Booking Details</h2>
                
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td style="padding: 8px 0; font-weight: 600; color: #475569; width: 40%;">Service:</td>
                        <td style="padding: 8px 0; color: #1e293b;">{{ $serviceType->name }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0; font-weight: 600; color: #475569;">Date & Time:</td>
                        <td style="padding: 8px 0; color: #1e293b;">{{ $booking->start_datetime->format('l, F j, Y \a\t g:i A') }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0; font-weight: 600; color: #475569;">Pickup Location:</td>
                        <td style="padding: 8px 0; color: #1e293b;">{{ $booking->pickup_location }}</td>
                    </tr>
                    @if($booking->dropoff_location)
                    <tr>
                        <td style="padding: 8px 0; font-weight: 600; color: #475569;">Drop-off Location:</td>
                        <td style="padding: 8px 0; color: #1e293b;">{{ $booking->dropoff_location }}</td>
                    </tr>
                    @endif
                </table>
            </div>

            <!-- Important Reminder -->
            <div style="background-color: #fef3c7; border-left: 4px solid #f59e0b; padding: 15px; margin: 20px 0; border-radius: 4px;">
                <p style="margin: 0; font-size: 14px; color: #92400e;">
                    <strong>Please ensure:</strong>
                </p>
                <ul style="margin: 10px 0 0 0; padding-left: 20px; color: #92400e; font-size: 14px;">
                    <li>You're available at the pickup location at the scheduled time</li>
                    <li>Your contact number is reachable</li>
                    <li>Payment has been completed (if required)</li>
                </ul>
            </div>

            <p style="font-size: 16px; margin: 20px 0 0 0;">
                If you need to make any changes or have questions, please contact us as soon as possible.
            </p>

            <p style="font-size: 16px; margin: 20px 0 0 0;">
                We look forward to serving you!<br>
                <strong>The Good2Go Team</strong>
            </p>
        </div>

        <!-- Footer -->
        <div style="background-color: #f8fafc; padding: 20px; text-align: center; border-top: 1px solid #e2e8f0;">
            <p style="font-size: 12px; color: #64748b; margin: 0 0 10px 0;">
                &copy; {{ date('Y') }} Good2Go. All rights reserved.
            </p>
        </div>
    </div>
</body>
</html>

