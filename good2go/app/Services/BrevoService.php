<?php

namespace App\Services;

use Brevo\Client\Api\TransactionalEmailsApi;
use Brevo\Client\Configuration;
use Brevo\Client\Model\SendSmtpEmail;
use Brevo\Client\Model\SendSmtpEmailTo;
use Brevo\Client\Model\SendSmtpEmailSender;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class BrevoService
{
    protected ?TransactionalEmailsApi $apiInstance = null;
    protected string $apiKey;

    public function __construct()
    {
        $this->apiKey = config('services.brevo.api_key');
        
        if ($this->apiKey) {
            $config = Configuration::getDefaultConfiguration()->setApiKey('api-key', $this->apiKey);
            $this->apiInstance = new TransactionalEmailsApi(
                new Client(),
                $config
            );
        }
    }

    /**
     * Send a transactional email via Brevo API
     *
     * @param string $to Email address
     * @param string $subject Email subject
     * @param string $htmlContent HTML content
     * @param string|null $textContent Plain text content (optional)
     * @param array $params Additional parameters (replyTo, attachments, etc.)
     * @return bool
     */
    public function sendEmail(
        string $to,
        string $subject,
        string $htmlContent,
        ?string $textContent = null,
        array $params = []
    ): bool {
        if (!$this->apiInstance) {
            Log::warning('Brevo API key not configured. Email not sent via API.');
            return false;
        }

        try {
            $sendSmtpEmail = new SendSmtpEmail([
                'sender' => new SendSmtpEmailSender([
                    'name' => $params['from_name'] ?? config('mail.from.name', 'Good2Go'),
                    'email' => $params['from_email'] ?? config('mail.from.address', 'noreply@good2go.com'),
                ]),
                'to' => [
                    new SendSmtpEmailTo([
                        'email' => $to,
                        'name' => $params['to_name'] ?? null,
                    ]),
                ],
                'subject' => $subject,
                'htmlContent' => $htmlContent,
                'textContent' => $textContent,
            ]);

            // Add reply-to if provided
            if (isset($params['reply_to'])) {
                $sendSmtpEmail->setReplyTo($params['reply_to']);
            }

            // Add CC if provided
            if (isset($params['cc'])) {
                $sendSmtpEmail->setCc(array_map(function ($email) {
                    return new SendSmtpEmailTo(['email' => $email]);
                }, is_array($params['cc']) ? $params['cc'] : [$params['cc']]));
            }

            // Add BCC if provided
            if (isset($params['bcc'])) {
                $sendSmtpEmail->setBcc(array_map(function ($email) {
                    return new SendSmtpEmailTo(['email' => $email]);
                }, is_array($params['bcc']) ? $params['bcc'] : [$params['bcc']]));
            }

            // Add tags for tracking
            if (isset($params['tags'])) {
                $sendSmtpEmail->setTags($params['tags']);
            }

            $result = $this->apiInstance->sendTransacEmail($sendSmtpEmail);
            
            Log::info('Brevo email sent successfully', [
                'message_id' => $result->getMessageId(),
                'to' => $to,
                'subject' => $subject,
            ]);

            return true;
        } catch (\Exception $e) {
            Log::error('Brevo API error: ' . $e->getMessage(), [
                'to' => $to,
                'subject' => $subject,
                'error' => $e->getMessage(),
            ]);

            return false;
        }
    }

    /**
     * Send email using a Brevo template
     *
     * @param int $templateId Brevo template ID
     * @param string $to Email address
     * @param array $templateParams Template parameters
     * @param array $params Additional parameters
     * @return bool
     */
    public function sendTemplateEmail(
        int $templateId,
        string $to,
        array $templateParams = [],
        array $params = []
    ): bool {
        if (!$this->apiInstance) {
            Log::warning('Brevo API key not configured. Template email not sent.');
            return false;
        }

        try {
            $sendSmtpEmail = new SendSmtpEmail([
                'to' => [
                    new SendSmtpEmailTo([
                        'email' => $to,
                        'name' => $params['to_name'] ?? null,
                    ]),
                ],
                'templateId' => $templateId,
                'params' => $templateParams,
            ]);

            if (isset($params['reply_to'])) {
                $sendSmtpEmail->setReplyTo($params['reply_to']);
            }

            $result = $this->apiInstance->sendTransacEmail($sendSmtpEmail);
            
            Log::info('Brevo template email sent successfully', [
                'message_id' => $result->getMessageId(),
                'template_id' => $templateId,
                'to' => $to,
            ]);

            return true;
        } catch (\Exception $e) {
            Log::error('Brevo template API error: ' . $e->getMessage(), [
                'template_id' => $templateId,
                'to' => $to,
                'error' => $e->getMessage(),
            ]);

            return false;
        }
    }

    /**
     * Check if Brevo API is configured
     *
     * @return bool
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiKey) && $this->apiInstance !== null;
    }
}

