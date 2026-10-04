<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Official Document • {{ $certificate->control_no }} • Barangay Dacutan</title>
  
  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  
  <!-- FontAwesome 6 Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
    @import url('https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700;800;900&family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400&family=Plus+Jakarta+Sans:wght@400;600;700&display=swap');

    body {
      font-family: 'Merriweather', Georgia, serif;
      background-color: #cbd5e1;
      color: #0f172a;
    }

    .font-cinzel {
      font-family: 'Cinzel', serif;
    }

    .font-sans-custom {
      font-family: 'Plus Jakarta Sans', sans-serif;
    }

    /* Standard A4 Paper Specs */
    .a4-sheet {
      width: 210mm;
      min-height: 297mm;
      padding: 12mm 15mm;
      margin: 20px auto;
      background: white;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
      box-sizing: border-box;
      position: relative;
    }

    @media print {
      body {
        background: white !important;
        margin: 0 !important;
        padding: 0 !important;
      }
      .no-print {
        display: none !important;
      }
      .a4-sheet {
        margin: 0 !important;
        padding: 10mm 14mm !important;
        width: 100% !important;
        min-height: 100% !important;
        box-shadow: none !important;
        border: none !important;
        page-break-after: avoid;
      }
    }
  </style>
</head>
<body class="antialiased selection:bg-amber-400 selection:text-slate-900">

  <!-- TOP ACTION TOOLBAR (HIDDEN IN PRINT) -->
  <div class="no-print sticky top-0 z-50 bg-slate-900/90 backdrop-blur-md border-b border-slate-800 text-white px-4 py-3 flex items-center justify-between shadow-lg">
    <div class="flex items-center gap-3">
      <a href="{{ route('admin.certificates.index') }}" class="px-3 py-1.5 rounded-lg bg-slate-800 hover:bg-slate-700 text-xs font-sans-custom font-bold flex items-center gap-2 transition-colors">
        <i class="fa-solid fa-arrow-left"></i>
        <span>Return to Register</span>
      </a>
      <span class="text-xs text-slate-400 font-sans-custom hidden sm:inline">
        Document: <strong class="text-emerald-400">{{ $certificate->control_no }}</strong> ({{ $certificate->doc_type }})
      </span>
    </div>

    <div class="flex items-center gap-3">
      <span class="text-[11px] text-amber-400 font-sans-custom hidden md:inline">
        <i class="fa-solid fa-circle-info"></i> For best results, choose Paper Size: <strong>A4</strong> and Margins: <strong>Default/None</strong>.
      </span>
      <button 
        onclick="window.print()" 
        class="px-5 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-sans-custom font-bold shadow-md shadow-emerald-950/40 flex items-center gap-2 transition-transform hover:scale-105"
      >
        <i class="fa-solid fa-print text-sm"></i>
        <span>Print Official Clearance</span>
      </button>
    </div>
  </div>

  <!-- A4 PRINTABLE DOCUMENT CONTAINER -->
  <div class="a4-sheet flex flex-col justify-between border-4 border-double border-slate-900">
    
    <!-- Outer Decorative Border -->
    <div class="flex-1 flex flex-col justify-between border border-slate-700 p-6 relative">
      
      <!-- Watermark Background Seal -->
      <div class="absolute inset-0 flex items-center justify-center pointer-events-none opacity-[0.04] z-0">
        <img src="{{ asset('assets/images/logo.svg') }}" alt="Seal Watermark" class="w-[420px] h-[420px] grayscale">
      </div>

      <!-- 1. OFFICIAL LETTERHEAD -->
      <header class="border-b-2 border-slate-900 pb-3 relative z-10">
        <div class="flex items-center justify-between">
          
          <!-- Left: Municipality Seal -->
          <div class="w-20 h-20 flex-shrink-0 flex items-center justify-center">
            <img src="{{ asset('assets/images/logo.svg') }}" alt="Dumangas Seal" class="w-18 h-18 object-contain">
          </div>

          <!-- Center Text Heading -->
          <div class="text-center flex-1 px-4 space-y-0.5">
            <h4 class="text-[11px] uppercase tracking-wider font-sans-custom font-semibold text-slate-700">Republic of the Philippines</h4>
            <h4 class="text-[11px] uppercase tracking-wider font-sans-custom font-semibold text-slate-700">Province of Iloilo • Municipality of Dumangas</h4>
            <h2 class="text-lg font-cinzel font-black tracking-wide text-slate-900">BARANGAY DACUTAN</h2>
            <div class="inline-block px-3 py-0.5 mt-1 border-t border-b border-slate-800">
              <h3 class="text-xs font-cinzel font-bold tracking-widest text-slate-900 uppercase">Office of the Punong Barangay</h3>
            </div>
          </div>

          <!-- Right: Barangay Dacutan Seal -->
          <div class="w-20 h-20 flex-shrink-0 flex items-center justify-center">
            <img src="{{ asset('assets/images/logo.svg') }}" alt="Barangay Seal" class="w-18 h-18 object-contain">
          </div>

        </div>
      </header>

      <!-- 2. TWO-COLUMN LAYOUT: COUNCIL ROSTER (LEFT) + DOCUMENT BODY (RIGHT) -->
      <div class="flex-1 flex gap-5 pt-4 relative z-10 min-h-0">
        
        <!-- Left Sidebar: Sangguniang Barangay Council Roster -->
        <aside class="w-48 border-r-2 border-slate-900 pr-3 flex-shrink-0 font-sans-custom text-[10px] space-y-2.5">
          
          <div class="text-center border-b border-slate-400 pb-2">
            <p class="font-extrabold text-[11px] text-slate-900 uppercase">HON. ROBERTO S. ALEN</p>
            <p class="text-[9px] font-bold text-slate-600">Punong Barangay (Captain)</p>
          </div>

          <div class="space-y-1.5 pt-1">
            <p class="text-[9px] font-extrabold uppercase text-slate-400 tracking-wider text-center">Barangay Kagawads</p>
            
            <div class="text-left">
              <p class="font-bold text-slate-800">HON. MA. ELENA FERNANDEZ</p>
              <p class="text-[8px] text-slate-500">Comm. on Rules & Ordinances</p>
            </div>

            <div class="text-left">
              <p class="font-bold text-slate-800">HON. JOSE RAMON DIAZ</p>
              <p class="text-[8px] text-slate-500">Comm. on Appropriations</p>
            </div>

            <div class="text-left">
              <p class="font-bold text-slate-800">HON. CARLOS GOMEZ</p>
              <p class="text-[8px] text-slate-500">Comm. on Peace & Order</p>
            </div>

            <div class="text-left">
              <p class="font-bold text-slate-800">HON. MARITES SANTOS</p>
              <p class="text-[8px] text-slate-500">Comm. on Health & Sanitation</p>
            </div>

            <div class="text-left">
              <p class="font-bold text-slate-800">HON. ANTONIO REYES</p>
              <p class="text-[8px] text-slate-500">Comm. on Agriculture</p>
            </div>

            <div class="text-left">
              <p class="font-bold text-slate-800">HON. PATRICIA LOPEZ</p>
              <p class="text-[8px] text-slate-500">Comm. on Women & Family</p>
            </div>

            <div class="text-left">
              <p class="font-bold text-slate-800">HON. EDUARDO CRUZ</p>
              <p class="text-[8px] text-slate-500">Comm. on Infrastructure</p>
            </div>
          </div>

          <div class="border-t border-slate-300 pt-2 space-y-1.5">
            <div class="text-left">
              <p class="font-bold text-slate-800">HON. C.J. BELMONTE</p>
              <p class="text-[8px] text-slate-500">SK Chairperson</p>
            </div>

            <div class="text-left">
              <p class="font-bold text-slate-800">MRS. MA. ELENA BALLEZA</p>
              <p class="text-[8px] text-slate-500">Barangay Secretary</p>
            </div>

            <div class="text-left">
              <p class="font-bold text-slate-800">MR. DANILO VILLANUEVA</p>
              <p class="text-[8px] text-slate-500">Barangay Treasurer</p>
            </div>
          </div>

        </aside>

        <!-- Right Main Body: Certificate Text -->
        <main class="flex-1 flex flex-col justify-between pl-2">
          
          <!-- Document Title -->
          <div class="text-center pt-2 pb-4">
            <h1 class="text-xl sm:text-2xl font-cinzel font-black tracking-widest text-slate-900 uppercase underline decoration-2 underline-offset-4">
              {{ $certificate->doc_type }}
            </h1>
          </div>

          <!-- Salutation -->
          <div class="text-left text-xs font-bold font-sans-custom uppercase tracking-wider text-slate-800 mb-3">
            TO WHOM IT MAY CONCERN:
          </div>

          <!-- Paragraphs -->
          <div class="space-y-4 text-justify text-xs sm:text-[13px] leading-relaxed text-slate-900 indent-8">
            
            @if($certificate->doc_type === 'Certificate of Indigency')
              <p>
                THIS IS TO CERTIFY that <strong class="font-black text-slate-950 uppercase underline">{{ $certificate->citizen_name }}</strong>, of legal age, Filipino, is a bona fide resident of <span class="font-bold">{{ $certificate->purok }}</span>, Barangay Dacutan, Municipality of Dumangas, Province of Iloilo.
              </p>
              <p>
                BASED ON COMMUNITY RECORDS and evaluation conducted by this office, the above-named individual belongs to an <strong class="font-bold">INDIGENT FAMILY</strong> with low economic subsistence and has no fixed or regular monthly income sufficient to support immediate personal, educational, or household medical needs.
              </p>
              <p>
                THIS CERTIFICATION is being issued upon the request of the interested party in connection with their application for: <strong class="font-black uppercase text-slate-950">{{ $certificate->purpose }}</strong>.
              </p>

            @elseif(str_contains($certificate->doc_type, 'First Time Job Seeker') || str_contains($certificate->doc_type, 'First-Time Jobseeker'))
              <p>
                THIS IS TO CERTIFY that <strong class="font-black text-slate-950 uppercase underline">{{ $certificate->citizen_name }}</strong>, Filipino, is a certified resident of <span class="font-bold">{{ $certificate->purok }}</span>, Barangay Dacutan, Dumangas, Iloilo, and is a qualified <strong class="font-bold">FIRST TIME JOBSEEKER</strong> pursuant to Republic Act No. 11261 (First Time Jobseekers Assistance Act of 2019).
              </p>
              <p>
                FURTHER CERTIFIES that the subject individual has executed the required Oath of Undertaking to abide by the provisions of said Act, thereby entitling him/her to the waiver of government fees and charges for pre-employment documentation.
              </p>
              <p>
                ISSUED for the specific purpose of: <strong class="font-black uppercase text-slate-950">{{ $certificate->purpose }}</strong>.
              </p>

            @elseif($certificate->doc_type === 'Certificate of Residency')
              <p>
                THIS IS TO CERTIFY that <strong class="font-black text-slate-950 uppercase underline">{{ $certificate->citizen_name }}</strong>, Filipino, is a permanent resident of <span class="font-bold">{{ $certificate->purok }}</span>, Barangay Dacutan, Municipality of Dumangas, Province of Iloilo, continuously residing in this barangay.
              </p>
              <p>
                FURTHER CERTIFIES that the subject person has exemplary civic standing, has shown active involvement in peaceful community development programs, and has established permanent domicile in this barangay.
              </p>
              <p>
                ISSUED upon request for the purpose of: <strong class="font-black uppercase text-slate-950">{{ $certificate->purpose }}</strong>.
              </p>

            @elseif($certificate->doc_type === 'Certificate of Good Moral Character')
              <p>
                THIS IS TO CERTIFY that <strong class="font-black text-slate-950 uppercase underline">{{ $certificate->citizen_name }}</strong>, of legal age, Filipino, is a bona fide resident of <span class="font-bold">{{ $certificate->purok }}</span>, Barangay Dacutan, Municipality of Dumangas, Province of Iloilo.
              </p>
              <p>
                FURTHER CERTIFIES that the subject individual is personally known to this office as a law-abiding citizen of <strong class="font-bold">GOOD MORAL CHARACTER</strong>, with high civic integrity, and has never been convicted of any crime involving moral turpitude nor has any derogatory or disciplinary record pending before the Barangay Council.
              </p>
              <p>
                ISSUED upon request of the interested party for the purpose of: <strong class="font-black uppercase text-slate-950">{{ $certificate->purpose }}</strong>.
              </p>

            @elseif($certificate->doc_type === 'Solo Parent Barangay Certification')
              <p>
                THIS IS TO CERTIFY that <strong class="font-black text-slate-950 uppercase underline">{{ $certificate->citizen_name }}</strong>, Filipino, residing at <span class="font-bold">{{ $certificate->purok }}</span>, Barangay Dacutan, Municipality of Dumangas, Province of Iloilo, is duly assessed and recognized by this office as a qualified <strong class="font-bold">SOLO PARENT</strong> pursuant to Republic Act No. 8972, as amended by Republic Act No. 11861 (Expanded Solo Parents Welfare Act).
              </p>
              <p>
                FURTHER CERTIFIES that the applicant is solely bearing the parental responsibility, custody, and economic support of dependent child/children within our barangay jurisdiction.
              </p>
              <p>
                ISSUED for the purpose of: <strong class="font-black uppercase text-slate-950">{{ $certificate->purpose }}</strong>.
              </p>

            @elseif($certificate->doc_type === 'Barangay ID')
              <p>
                THIS IS TO CERTIFY that <strong class="font-black text-slate-950 uppercase underline">{{ $certificate->citizen_name }}</strong>, Filipino, residing at <span class="font-bold">{{ $certificate->purok }}</span>, Barangay Dacutan, Municipality of Dumangas, Province of Iloilo, is an officially verified and enrolled citizen in the master database of the Barangay Information and Management System (BIMS).
              </p>
              <p>
                THIS OFFICIAL RECORD serves as verification of identity, local domicile, and community residency under Barangay Dacutan municipal governance.
              </p>
              <p>
                ISSUED for the purpose of: <strong class="font-black uppercase text-slate-950">{{ $certificate->purpose }}</strong>.
              </p>

            @elseif(str_contains($certificate->doc_type, 'Business Clearance'))
              <p>
                THIS IS TO CERTIFY that business clearance is hereby granted to <strong class="font-black text-slate-950 uppercase underline">{{ $certificate->citizen_name }}</strong> for the operation and registration of the commercial business enterprise located at <span class="font-bold">{{ $certificate->purok }}</span>, Barangay Dacutan, Dumangas, Iloilo.
              </p>
              <p>
                FURTHER CERTIFIES that the aforementioned commercial establishment has complied with the basic sanitation, fire safety, environmental standards, and local barangay regulatory ordinances within our jurisdiction, and has paid the corresponding barangay clearance fees.
              </p>
              <p>
                ISSUED for business permit licensing / renewal purpose: <strong class="font-black uppercase text-slate-950">{{ $certificate->purpose }}</strong>.
              </p>

            @elseif(str_contains($certificate->doc_type, 'Building') || str_contains($certificate->doc_type, 'Construction'))
              <p>
                THIS IS TO CERTIFY that clearance is hereby granted to <strong class="font-black text-slate-950 uppercase underline">{{ $certificate->citizen_name }}</strong> for the proposed building construction, renovation, or structural development located at <span class="font-bold">{{ $certificate->purok }}</span>, Barangay Dacutan, Dumangas, Iloilo.
              </p>
              <p>
                FURTHER CERTIFIES that an on-site ocular verification conducted by barangay authorities indicates that the proposed project conforms with community safety, public right-of-way boundaries, and local zoning guidelines, with no adverse complaints from adjacent property owners.
              </p>
              <p>
                ISSUED for the purpose of securing Municipal Building / Zoning Permits: <strong class="font-black uppercase text-slate-950">{{ $certificate->purpose }}</strong>.
              </p>

            @elseif(str_contains($certificate->doc_type, 'No Objection'))
              <p>
                THIS IS TO CERTIFY that the Sangguniang Barangay of Dacutan, Municipality of Dumangas, Province of Iloilo, interposes <strong class="font-bold">NO OBJECTION</strong> to the undertaking, public utility installation, community event, or project requested by <strong class="font-black text-slate-950 uppercase underline">{{ $certificate->citizen_name }}</strong> at <span class="font-bold">{{ $certificate->purok }}</span>.
              </p>
              <p>
                FURTHER CERTIFIES that the proposed activity is found not detrimental to public welfare, public order, and peaceful coexistence of the neighborhood, subject to compliance with all existing municipal and national guidelines.
              </p>
              <p>
                ISSUED upon request for: <strong class="font-black uppercase text-slate-950">{{ $certificate->purpose }}</strong>.
              </p>

            @elseif(str_contains($certificate->doc_type, 'Blotter'))
              <p>
                THIS IS TO CERTIFY that according to the Katarungang Pambarangay Blotter Book of Barangay Dacutan, Dumangas, Iloilo, there is an official incident/complaint recorded involving or requested by <strong class="font-black text-slate-950 uppercase underline">{{ $certificate->citizen_name }}</strong> of <span class="font-bold">{{ $certificate->purok }}</span>.
              </p>
              <p>
                THIS CERTIFICATION constitutes an authenticated excerpt from the official blotter records maintained by this office for evidentiary and documentation purposes under Section 403 of Republic Act No. 7160.
              </p>
              <p>
                ISSUED for: <strong class="font-black uppercase text-slate-950">{{ $certificate->purpose }}</strong>.
              </p>

            @elseif(str_contains($certificate->doc_type, 'File Action') || str_contains($certificate->doc_type, 'CFA'))
              <p>
                THIS IS TO CERTIFY that pursuant to Chapter VII, Title I, Book III of Republic Act No. 7160 (Katarungang Pambarangay Law), the dispute involving or initiated by <strong class="font-black text-slate-950 uppercase underline">{{ $certificate->citizen_name }}</strong> regarding <strong class="font-black uppercase text-slate-950">{{ $certificate->purpose }}</strong> was submitted for conciliation and mediation.
              </p>
              <p>
                FURTHER CERTIFIES that despite honest efforts and personal appearances before the Punong Barangay and the Pangkat ng Tagapagkasundo, <strong class="font-bold">NO AMICABLE SETTLEMENT WAS REACHED</strong>, and the respondent has failed/refused to settle or conciliate the controversy.
              </p>
              <p>
                THEREFORE, the corresponding complaint for the dispute may now be formally filed in court or in the proper government office.
              </p>

            @else
              <!-- Standard Barangay Clearance -->
              <p>
                THIS IS TO CERTIFY that <strong class="font-black text-slate-950 uppercase underline">{{ $certificate->citizen_name }}</strong>, of legal age, Filipino, is a verified resident of <span class="font-bold">{{ $certificate->purok }}</span>, Barangay Dacutan, Municipality of Dumangas, Province of Iloilo.
              </p>
              <p>
                FURTHER CERTIFIES that according to the Katarungang Pambarangay Blotter and Barangay Peacekeeping Action Team (BPAT) records of this office, the aforementioned individual has <strong class="font-bold uppercase tracking-wide">NO DEROGATORY OR CRIMINAL RECORD</strong> filed against him/her, is known to be of good moral character, and is a peaceful, law-abiding citizen of the community.
              </p>
              <p>
                THIS CLEARANCE is hereby granted upon the request of the interested party for the purpose of: <strong class="font-black uppercase text-slate-950">{{ $certificate->purpose }}</strong>.
              </p>
            @endif

            <!-- Attestation clause -->
            <p>
              GIVEN this <strong class="font-bold">{{ $certificate->issue_date ? $certificate->issue_date->format('jS') : date('jS') }}</strong> day of <strong class="font-bold">{{ $certificate->issue_date ? $certificate->issue_date->format('F, Y') : date('F, Y') }}</strong> at the Barangay Hall of Dacutan, Dumangas, Iloilo, Republic of the Philippines.
            </p>

          </div>

          <!-- Thumbmarks & Signatures Section -->
          <div class="pt-6 space-y-4">
            
            <div class="flex items-end justify-between gap-4 font-sans-custom">
              
              <!-- Thumbmark Box -->
              <div class="flex items-center gap-2">
                <div class="w-20 h-20 border-2 border-slate-800 flex flex-col justify-end p-1 text-center bg-slate-50/50">
                  <span class="text-[8px] uppercase text-slate-400 font-bold">Left Thumb</span>
                </div>
                <div class="w-20 h-20 border-2 border-slate-800 flex flex-col justify-end p-1 text-center bg-slate-50/50">
                  <span class="text-[8px] uppercase text-slate-400 font-bold">Right Thumb</span>
                </div>
              </div>

              <!-- Applicant Signature Line -->
              <div class="text-center flex-1 max-w-[200px]">
                <div class="border-b-2 border-slate-900 pb-1 mb-1">
                  <span class="font-bold text-[11px] uppercase tracking-wider text-slate-900">{{ $certificate->citizen_name }}</span>
                </div>
                <p class="text-[9px] uppercase font-bold text-slate-500">Applicant / Affiant</p>
              </div>

            </div>

            <!-- Official Attestation Signatures -->
            <div class="flex items-end justify-between pt-6 font-sans-custom text-xs">
              
              <!-- Secretary Attestation -->
              <div class="text-left space-y-1">
                <p class="text-[10px] text-slate-500 font-bold uppercase">Attested by:</p>
                <div class="pt-6">
                  <p class="font-black text-slate-900 uppercase">MRS. MA. ELENA BALLEZA</p>
                  <p class="text-[10px] text-slate-600 font-medium">Barangay Secretary</p>
                </div>
              </div>

              <!-- Dry Seal Watermark Ring -->
              <div class="w-24 h-24 rounded-full border-2 border-dashed border-slate-400 flex flex-col items-center justify-center text-center p-1 text-[8px] font-bold text-slate-400 uppercase leading-tight select-none">
                <span>Republic of the Philippines</span>
                <span class="text-[11px] text-slate-500">★</span>
                <span>Barangay Dacutan Official Dry Seal</span>
              </div>

              <!-- Punong Barangay Approval -->
              <div class="text-right space-y-1">
                <p class="text-[10px] text-slate-500 font-bold uppercase">Approved by:</p>
                <div class="pt-6">
                  <p class="font-black text-slate-900 uppercase">HON. ROBERTO S. ALEN</p>
                  <p class="text-[10px] text-slate-600 font-medium">Punong Barangay (Captain)</p>
                </div>
              </div>

            </div>

          </div>

          <!-- 3. DOCUMENT METADATA FOOTER -->
          <footer class="pt-4 border-t border-slate-400 font-sans-custom text-[9px] text-slate-600 flex items-center justify-between">
            <div class="space-y-0.5">
              <p>Control / Tracking No: <strong class="font-mono text-slate-900 font-bold">{{ $certificate->control_no }}</strong></p>
              <p>CTC No: <strong class="font-mono text-slate-900">{{ $certificate->ctc_no ?? 'EXEMPT' }}</strong> • OR No: <strong class="font-mono text-slate-900">{{ $certificate->or_no ?? 'EXEMPT' }}</strong></p>
              <p>Fee Paid: <strong class="font-mono text-slate-900">₱{{ number_format($certificate->amount_paid, 2) }}</strong></p>
            </div>
            <div class="text-right space-y-0.5">
              <p>Official Verification Reference</p>
              <p class="text-slate-400">Validity: Six (6) Months from Date of Issue</p>
              <p class="font-bold text-slate-700">NOT VALID WITHOUT OFFICIAL DRY SEAL</p>
            </div>
          </footer>

        </main>

      </div>

    </div>

  </div>

</body>
</html>
