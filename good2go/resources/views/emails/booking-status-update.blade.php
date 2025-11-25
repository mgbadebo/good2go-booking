<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Status Update</title>
</head>
<body style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif; line-height: 1.6; color: #1e293b; background-color: #f8fafc; margin: 0; padding: 0;">
    <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 0;">
        <!-- Header -->
        <div style="background: linear-gradient(135deg, #4F46E5 0%, #6366F1 100%); padding: 30px 20px; text-align: center;">
            <h1 style="color: #ffffff; margin: 0; font-size: 24px; font-weight: 700;">Good2Go</h1>
            <p style="color: #e0e7ff; margin: 5px 0 0 0; font-size: 14px;">Booking Status Update</p>
        </div>

        <!-- Content -->
        <div style="padding: 30px 20px;">
            <p style="font-size: 16px; margin: 0 0 20px 0;">Hello {{ $user->name }},</p>
            
            <p style="font-size: 16px; margin: 0 0 20px 0;">
                Your booking status has been updated.
            </p>

            <!-- Status Change -->
            <div style="background-color: #f1f5f9; border-radius: 8px; padding: 20px; margin: 20px 0; text-align: center;">
                <p style="margin: 0 0 10px 0; font-size: 14px; color: #64748b;">Previous Status</p>
                <p style="margin: 0 0 20px 0; font-size: 18px; font-weight: 600; color: #475569;">
                    {{ ucfirst(str_replace('_', ' ', $oldStatus)) }}
                </p>
                <div style="font-size: 24px; color: #94a3b8;">↓</div>
                <p style="margin: 20px 0 10px 0; font-size: 14px; color: #64748b;">New Status</p>
                <p style="margin: 0; font-size: 20px; font-weight: 700; color: #4F46E5;">
                    {{ ucfirst(str_replace('_', ' ', $newStatus)) }}
                </p>
            </div>

            <!-- Booking Summary -->
            <div style="background-color: #f8fafc; border-radius: 8px; padding: 15px; margin: 20px 0;">
                <p style="margin: 0 0 10px 0; font-size: 14px; font-weight: 600; color: #475569;">Booking #{{ $booking->id }}</p>
                <p style="margin: 0 0 5px 0; font-size: 14px; color: #64748b;">{{ $serviceType->name }} • {{ ucfirst($booking->hire_type) }}</p>
                <p style="margin: 0; font-size: 14px; color: #64748b;">{{ $booking->start_datetime->format('F j, Y \a\t g:i A') }}</p>
            </div>

            @if($newStatus === 'confirmed')
            <div style="background-color: #d1fae5; border-left: 4px solid #10b981; padding: 15px; margin: 20px 0; border-radius: 4px;">
                <p style="margin: 0; font-size: 14px; color: #065f46;">
                    <strong>Great news!</strong> Your booking has been confirmed. Your driver will arrive at the scheduled time and location.
                </p>
            </div>
            @elseif($newStatus === 'cancelled')
            <div style="background-color: #fee2e2; border-left: 4px solid #ef4444; padding: 15px; margin: 20px 0; border-radius: 4px;">
                <p style="margin: 0; font-size: 14px; color: #991b1b;">
                    Your booking has been cancelled. If you made a payment, a refund will be processed according to our refund policy.
                </p>
            </div>
            @elseif($newStatus === 'completed')
            <div style="background-color: #dbeafe; border-left: 4px solid #3b82f6; padding: 15px; margin: 20px 0; border-radius: 4px;">
                <p style="margin: 0; font-size: 14px; color: #1e40af;">
                    Your booking has been completed. We hope you had a great experience with Good2Go!
                </p>
            </div>
            @endif

            <p style="font-size: 16px; margin: 20px 0 0 0;">
                If you have any questions, please contact us.
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
        </div>
    </div>
</body>
</html>

