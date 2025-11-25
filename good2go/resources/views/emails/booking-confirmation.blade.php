<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
</head>
<body style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif; line-height: 1.6; color: #1e293b; background-color: #f8fafc; margin: 0; padding: 0;">
    <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 0;">
        <!-- Header -->
        <div style="background: linear-gradient(135deg, #4F46E5 0%, #6366F1 100%); padding: 30px 20px; text-align: center;">
            <h1 style="color: #ffffff; margin: 0; font-size: 24px; font-weight: 700;">Good2Go</h1>
            <p style="color: #e0e7ff; margin: 5px 0 0 0; font-size: 14px;">Booking Confirmation</p>
        </div>

        <!-- Content -->
        <div style="padding: 30px 20px;">
            <p style="font-size: 16px; margin: 0 0 20px 0;">Hello {{ $user->name }},</p>
            
            <p style="font-size: 16px; margin: 0 0 20px 0;">
                Thank you for booking with Good2Go! Your booking has been received and is being processed.
            </p>

            <!-- Booking Details -->
            <div style="background-color: #f1f5f9; border-radius: 8px; padding: 20px; margin: 20px 0;">
                <h2 style="font-size: 18px; font-weight: 600; margin: 0 0 15px 0; color: #1e293b;">Booking Details</h2>
                
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td style="padding: 8px 0; font-weight: 600; color: #475569; width: 40%;">Booking ID:</td>
                        <td style="padding: 8px 0; color: #1e293b;">#{{ $booking->id }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0; font-weight: 600; color: #475569;">Service:</td>
                        <td style="padding: 8px 0; color: #1e293b;">{{ $serviceType->name }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0; font-weight: 600; color: #475569;">Hire Type:</td>
                        <td style="padding: 8px 0; color: #1e293b;">{{ ucfirst($booking->hire_type) }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0; font-weight: 600; color: #475569;">Date & Time:</td>
                        <td style="padding: 8px 0; color: #1e293b;">{{ $booking->start_datetime->format('l, F j, Y \a\t g:i A') }}</td>
                    </tr>
                    @if($booking->end_datetime)
                    <tr>
                        <td style="padding: 8px 0; font-weight: 600; color: #475569;">End Time:</td>
                        <td style="padding: 8px 0; color: #1e293b;">{{ $booking->end_datetime->format('g:i A') }}</td>
                    </tr>
                    @endif
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
                    <tr>
                        <td style="padding: 8px 0; font-weight: 600; color: #475569;">Total Amount:</td>
                        <td style="padding: 8px 0; color: #1e293b; font-weight: 600; font-size: 18px;">₦{{ number_format($booking->total_price, 2) }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0; font-weight: 600; color: #475569;">Status:</td>
                        <td style="padding: 8px 0;">
                            <span style="background-color: #fef3c7; color: #92400e; padding: 4px 12px; border-radius: 12px; font-size: 12px; font-weight: 600;">
                                {{ ucfirst(str_replace('_', ' ', $booking->booking_status)) }}
                            </span>
                        </td>
                    </tr>
                </table>
            </div>

            <!-- Payment Instructions -->
            <div style="background-color: #eff6ff; border-left: 4px solid #4F46E5; padding: 15px; margin: 20px 0; border-radius: 4px;">
                <p style="margin: 0; font-size: 14px; color: #1e40af;">
                    <strong>Payment:</strong> Your booking is currently pending payment. We will send you payment instructions shortly. 
                    Once payment is confirmed, your booking will be confirmed.
                </p>
            </div>

            <!-- Next Steps -->
            <div style="margin: 20px 0;">
                <h3 style="font-size: 16px; font-weight: 600; margin: 0 0 10px 0; color: #1e293b;">What's Next?</h3>
                <ul style="margin: 0; padding-left: 20px; color: #475569;">
                    <li style="margin-bottom: 8px;">We will confirm driver availability within 24 hours</li>
                    <li style="margin-bottom: 8px;">You will receive payment instructions via email</li>
                    <li style="margin-bottom: 8px;">Once payment is confirmed, your booking will be finalized</li>
                    <li style="margin-bottom: 8px;">You'll receive a reminder 24 hours before your booking</li>
                </ul>
            </div>

            <p style="font-size: 16px; margin: 20px 0 0 0;">
                If you have any questions, please don't hesitate to contact us.
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

