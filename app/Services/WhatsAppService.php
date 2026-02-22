<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsAppService
{
    protected string $apiUrl;
    protected string $token;

    public function __construct()
    {
        $this->apiUrl = config('services.fonnte.api_url');
        $this->token = config('services.fonnte.token');
    }

    /**
     * Send WhatsApp message via Fonnte API
     *
     * @param string $phoneNumber Phone number in format 62xxx
     * @param string $message Message content
     * @return array Response from Fonnte API
     */
    public function sendMessage(string $phoneNumber, string $message): array
    {
        // Validate configuration
        if (empty($this->token)) {
            Log::warning('Fonnte API not configured');
            return [
                'success' => false,
                'error' => 'WhatsApp API not configured'
            ];
        }

        // Validate and format phone number
        $phoneNumber = $this->formatPhoneNumber($phoneNumber);
        if (!$phoneNumber) {
            Log::warning('Invalid WhatsApp phone number format');
            return [
                'success' => false,
                'error' => 'Invalid phone number format'
            ];
        }

        try {
            // Send request to Fonnte API
            $response = Http::withHeaders([
                'Authorization' => $this->token,
            ])->asForm()->post($this->apiUrl, [
                'target' => $phoneNumber,
                'message' => $message,
                'countryCode' => '62',
            ]);

            // Log response
            Log::info('WhatsApp message sent', [
                'phone' => $phoneNumber,
                'status' => $response->status(),
                'response' => $response->json()
            ]);

            // Check if successful
            if ($response->successful()) {
                $data = $response->json();
                return [
                    'success' => $data['status'] ?? false,
                    'data' => $data
                ];
            }

            return [
                'success' => false,
                'error' => 'Failed to send WhatsApp message',
                'response' => $response->json()
            ];

        } catch (\Exception $e) {
            Log::error('WhatsApp send failed', [
                'phone' => $phoneNumber,
                'error' => $e->getMessage()
            ]);

            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Send broadcast message to multiple phone numbers
     *
     * @param array $phoneNumbers Array of phone numbers
     * @param string $message Message content
     * @return array Response from Fonnte API
     */
    public function sendBroadcast(array $phoneNumbers, string $message): array
    {
        // Validate configuration
        if (empty($this->token)) {
            Log::warning('Fonnte API not configured');
            return [
                'success' => false,
                'error' => 'WhatsApp API not configured'
            ];
        }

        // Format all phone numbers
        $formattedPhones = array_filter(array_map(function($phone) {
            return $this->formatPhoneNumber($phone);
        }, $phoneNumbers));

        if (empty($formattedPhones)) {
            return [
                'success' => false,
                'error' => 'No valid phone numbers provided'
            ];
        }

        try {
            // Send request to Fonnte API
            $response = Http::withHeaders([
                'Authorization' => $this->token,
            ])->asForm()->post($this->apiUrl, [
                'target' => implode(',', $formattedPhones),
                'message' => $message,
                'countryCode' => '62',
            ]);

            // Log response
            Log::info('WhatsApp broadcast sent', [
                'phones_count' => count($formattedPhones),
                'status' => $response->status(),
                'response' => $response->json()
            ]);

            // Check if successful
            if ($response->successful()) {
                $data = $response->json();
                return [
                    'success' => $data['status'] ?? false,
                    'data' => $data
                ];
            }

            return [
                'success' => false,
                'error' => 'Failed to send WhatsApp broadcast',
                'response' => $response->json()
            ];

        } catch (\Exception $e) {
            Log::error('WhatsApp broadcast failed', [
                'phones_count' => count($formattedPhones),
                'error' => $e->getMessage()
            ]);

            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Format phone number to valid WhatsApp format (62xxx)
     *
     * @param string|null $phoneNumber
     * @return string|null
     */
    protected function formatPhoneNumber(?string $phoneNumber): ?string
    {
        if (empty($phoneNumber)) {
            return null;
        }

        // Remove any spaces, dashes, or special characters
        $phoneNumber = preg_replace('/[^0-9]/', '', $phoneNumber);

        // Remove leading zeros or plus
        $phoneNumber = ltrim($phoneNumber, '+0');

        // If doesn't start with 62, add it (assuming Indonesian number)
        if (substr($phoneNumber, 0, 2) !== '62') {
            $phoneNumber = '62' . $phoneNumber;
        }

        // Validate length (Indonesian phone should be 62 + 9-12 digits)
        if (strlen($phoneNumber) < 11 || strlen($phoneNumber) > 15) {
            return null;
        }

        return $phoneNumber;
    }

    /**
     * Check if WhatsApp is configured and available
     *
     * @return bool
     */
    public function isAvailable(): bool
    {
        return !empty($this->token);
    }

    /**
     * Send OTP verification code
     *
     * @param string $phone Phone number
     * @param string $code OTP code
     * @return array
     */
    public function sendOTP(string $phone, string $code): array
    {
        $message = "Kode verifikasi Anda: *{$code}*\n\nJangan bagikan kode ini kepada siapapun.";
        
        return $this->sendMessage($phone, $message);
    }

    /**
     * Send password reset OTP
     *
     * @param string $phone Phone number
     * @param string $code OTP code
     * @return array
     */
    public function sendPasswordResetOTP(string $phone, string $code): array
    {
        $message = "🔐 *Reset Password*\n\n";
        $message .= "Kode reset password Anda: *{$code}*\n\n";
        $message .= "Kode ini berlaku selama 10 menit.\n";
        $message .= "Jangan bagikan kode ini kepada siapapun.\n\n";
        $message .= "Jika Anda tidak meminta reset password, abaikan pesan ini.";
        
        return $this->sendMessage($phone, $message);
    }

    /**
     * Send purchase confirmation notification
     *
     * @param string $phone Phone number
     * @param string $courseTitle Course title
     * @param float $amount Amount paid
     * @return array
     */
    public function sendPurchaseNotification(string $phone, string $courseTitle, float $amount): array
    {
        $formattedAmount = 'Rp ' . number_format($amount, 0, ',', '.');
        
        $message = "🎉 *Pembayaran Dikonfirmasi!*\n\n";
        $message .= "Kursus: *{$courseTitle}*\n";
        $message .= "Jumlah: *{$formattedAmount}*\n\n";
        $message .= "Selamat! Kamu sekarang bisa mengakses kursus ini. Selamat belajar! 🚀";
        
        return $this->sendMessage($phone, $message);
    }

    /**
     * Send payment verification notification with course access link
     *
     * @param string $phone Phone number
     * @param string $courseTitle Course title
     * @param string $courseLink Link to access the course
     * @return array
     */
    public function sendPaymentVerificationNotification(string $phone, string $courseTitle, string $courseLink): array
    {
        $message = "✅ *Selamat! Pembayaran Sudah Diverifikasi*\n\n";
        $message .= "Pembayaran untuk kursus *{$courseTitle}* sudah berhasil diverifikasi.\n\n";
        $message .= "Silakan lanjut belajar ke link akses belajarnya kursus yang dibeli:\n\n";
        $message .= "🔗 {$courseLink}\n\n";
        $message .= "Selamat belajar! 🚀";
        
        return $this->sendMessage($phone, $message);
    }

    /**
     * Send invoice notification with payment proof upload link
     *
     * @param string $phone Phone number
     * @param string $courseTitle Course title
     * @param float $amount Amount to pay
     * @param string $transactionId Transaction ID
     * @param string $uploadLink Link to upload payment proof
     * @return array
     */
    public function sendInvoiceNotification(string $phone, string $courseTitle, float $amount, string $transactionId, string $uploadLink): array
    {
        $formattedAmount = 'Rp ' . number_format($amount, 0, ',', '.');
        
        $message = "📋 *Tagihan Pembayaran Kursus*\n\n";
        $message .= "Kursus: *{$courseTitle}*\n";
        $message .= "Jumlah: *{$formattedAmount}*\n";
        $message .= "ID Transaksi: *{$transactionId}*\n\n";
        $message .= "Silakan lakukan pembayaran sesuai metode yang dipilih, kemudian upload bukti pembayaran melalui link berikut:\n\n";
        $message .= "🔗 {$uploadLink}\n\n";
        $message .= "Setelah bukti pembayaran diverifikasi, Anda akan mendapat notifikasi dan dapat langsung mengakses kursus.";
        
        return $this->sendMessage($phone, $message);
    }

    /**
     * Send notification to admin about new payment proof upload
     *
     * @param string $phone Admin phone number
     * @param string $userName User name
     * @param string $courseTitle Course title
     * @param float $amount Amount paid
     * @param string $transactionId Transaction ID
     * @param string $adminLink Link to admin enrollment page
     * @return array
     */
    public function sendAdminPaymentNotification(string $phone, string $userName, string $courseTitle, float $amount, string $transactionId, string $adminLink): array
    {
        $formattedAmount = 'Rp ' . number_format($amount, 0, ',', '.');
        
        $message = "🔔 *Notifikasi Transaksi Baru*\n\n";
        $message .= "Ada transaksi baru yang memerlukan verifikasi:\n\n";
        $message .= "👤 User: *{$userName}*\n";
        $message .= "📚 Kursus: *{$courseTitle}*\n";
        $message .= "💰 Jumlah: *{$formattedAmount}*\n";
        $message .= "🆔 ID Transaksi: *{$transactionId}*\n\n";
        $message .= "Bukti pembayaran sudah di-upload. Silakan verifikasi pembayaran melalui link berikut:\n\n";
        $message .= "🔗 {$adminLink}\n\n";
        $message .= "Setelah diverifikasi, user dapat langsung mengakses kursus.";
        
        return $this->sendMessage($phone, $message);
    }
}
