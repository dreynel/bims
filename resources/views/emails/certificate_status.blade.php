<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Document Status Update - Barangay Dacutan</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px;">
  
  <div style="background-color: #064e3b; color: white; padding: 20px; text-align: center; border-radius: 8px 8px 0 0;">
    <h2 style="margin: 0; font-size: 18px; text-transform: uppercase;">Republic of the Philippines</h2>
    <h3 style="margin: 5px 0 0; font-size: 16px;">Barangay Dacutan, Dumangas, Iloilo</h3>
    <p style="margin: 5px 0 0; font-size: 12px; color: #a7f3d0;">Official Information Management & Document Tracking System</p>
  </div>

  <div style="background-color: #ffffff; padding: 25px; border: 1px solid #e5e7eb; border-top: none; border-radius: 0 0 8px 8px;">
    <p>Dear <strong>{{ $certificate->citizen_name }}</strong>,</p>

    <p>This is an automated status advisory regarding your application for <strong>{{ $certificate->doc_type }}</strong>.</p>

    <div style="background-color: #f9fafb; border-left: 4px solid #059669; padding: 15px; margin: 20px 0;">
      <p style="margin: 0 0 8px;"><strong>Application Reference Number:</strong> <code style="font-size: 14px; color: #065f46; font-weight: bold;">{{ $certificate->control_no }}</code></p>
      <p style="margin: 0 0 8px;"><strong>Document Requested:</strong> {{ $certificate->doc_type }}</p>
      <p style="margin: 0 0 8px;"><strong>Application Purpose:</strong> {{ $certificate->purpose }}</p>
      <p style="margin: 0 0 8px;"><strong>Current Status:</strong> <span style="background-color: #d1fae5; color: #065f46; padding: 3px 8px; border-radius: 4px; font-weight: bold;">{{ $certificate->status }}</span></p>
      @if($certificate->remarks)
        <p style="margin: 0 0 8px;"><strong>Official Remarks:</strong> {{ $certificate->remarks }}</p>
      @endif
      <p style="margin: 0;"><strong>Official Fee:</strong> ₱{{ number_format($certificate->amount_paid, 2) }} {{ $certificate->amount_paid == 0 ? '(Statutory Fee Waiver)' : '' }}</p>
    </div>

    @if($certificate->status === 'Ready for Release')
      <div style="background-color: #eff6ff; border: 1px solid #bfdbfe; padding: 15px; border-radius: 6px; margin-bottom: 20px;">
        <h4 style="margin: 0 0 8px; color: #1e40af;">Pickup Guidelines at Barangay Hall:</h4>
        <ul style="margin: 0; padding-left: 20px; font-size: 13px; color: #1e3a8a;">
          <li>Visit Window 1: Office of the Barangay Secretary, Barangay Hall of Dacutan.</li>
          <li>Office hours: Monday to Friday, 8:00 AM to 5:00 PM.</li>
          <li>Please present a valid ID or your online reference code: <strong>{{ $certificate->control_no }}</strong>.</li>
        </ul>
      </div>
    @endif

    <p style="font-size: 13px; color: #6b7280;">You can track the live processing status of your clearance anytime on our citizen portal.</p>

    <hr style="border: none; border-top: 1px solid #e5e7eb; margin: 25px 0;">

    <p style="font-size: 11px; color: #9ca3af; text-align: center; margin: 0;">
      Office of the Punong Barangay & Sangguniang Barangay • Dacutan, Dumangas, Iloilo<br>
      This is an automated system notification. Please do not reply directly to this email.
    </p>
  </div>

</body>
</html>
