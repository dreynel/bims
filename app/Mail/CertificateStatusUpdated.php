<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Certificate;

class CertificateStatusUpdated extends Mailable
{
    use Queueable, SerializesModels;

    public Certificate $certificate;

    /**
     * Create a new message instance.
     */
    public function __construct(Certificate $certificate)
    {
        $this->certificate = $certificate;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $status = $this->certificate->status;
        $subject = match ($status) {
            'Pending' => "Application Received [Ref #{$this->certificate->control_no}] - Barangay Dacutan",
            'Evaluated' => "Clerical Review Complete: Endorsed [Ref #{$this->certificate->control_no}] - Barangay Dacutan",
            'Approved' => "Official Clearance Approved [Ref #{$this->certificate->control_no}] - Barangay Dacutan",
            'Ready for Release' => "Ready for Release / Pickup [Ref #{$this->certificate->control_no}] - Barangay Dacutan",
            'Claimed' => "Document Claimed & Released [Ref #{$this->certificate->control_no}] - Barangay Dacutan",
            'Rejected' => "Notice of Requirement Compliance [Ref #{$this->certificate->control_no}] - Barangay Dacutan",
            default => "Document Update [Ref #{$this->certificate->control_no}] - Barangay Dacutan",
        };

        return new Envelope(
            subject: $subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.certificate_status',
        );
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        return [];
    }
}
