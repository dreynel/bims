import os
import subprocess
import plantuml
from PIL import Image

output_dir = os.path.abspath('Documentation/Diagrams')
os.makedirs(output_dir, exist_ok=True)
chrome_path = r'C:\Program Files\Google\Chrome\Application\chrome.exe'

# ==============================================================================
# 1. GENERATE FIGURE 1: CONCEPTUAL FRAMEWORK (SVG -> HIGH-RES PNG)
#    Requirements:
#    - Exact SAME HEIGHT for Input, Process, Output containers (height=460)
#    - Output contains ONLY the name of the system
#    - NO text on any lines/arrows
#    - Visually prominent, large font sizes
#    - Bottom evaluation/feedback container with its own height
# ==============================================================================
def generate_figure1_svg():
    svg_path = os.path.join(output_dir, "figure1_conceptual_framework.svg")
    png_path = os.path.join(output_dir, "figure1_conceptual_framework.png")

    svg_content = """<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1280 660" width="1280" height="660">
    <defs>
        <marker id="arrow" viewBox="0 0 10 10" refX="8" refY="5" markerWidth="7" markerHeight="7" orient="auto-start-reverse">
            <path d="M 0 1.5 L 8 5 L 0 8.5 z" fill="#000000"/>
        </marker>
        <filter id="shadow" x="-3%" y="-3%" width="106%" height="106%">
            <feDropShadow dx="2" dy="2" stdDeviation="2" flood-color="#000000" flood-opacity="0.1"/>
        </filter>
    </defs>

    <!-- Background -->
    <rect width="1280" height="660" fill="#FFFFFF"/>

    <!-- ==================== 1. INPUT CONTAINER (Height: 460) ==================== -->
    <rect x="40" y="40" width="360" height="460" rx="6" fill="#FFFFFF" stroke="#000000" stroke-width="2" filter="url(#shadow)"/>
    <!-- Header banner -->
    <rect x="40" y="40" width="360" height="46" rx="6" fill="#F0F0F0" stroke="#000000" stroke-width="2"/>
    <text x="220" y="70" font-family="'Segoe UI', Arial, sans-serif" font-size="18" font-weight="bold" text-anchor="middle" fill="#000000">INPUT</text>

    <!-- Input Content (Large, Crisp Text) -->
    <!-- Section 1 -->
    <text x="60" y="115" font-family="'Segoe UI', Arial, sans-serif" font-size="14" font-weight="bold" fill="#000000">Resident Census Information</text>
    <text x="70" y="137" font-family="'Segoe UI', Arial, sans-serif" font-size="13" fill="#222222">• Demographics (Name, Age, Gender, Civil Status)</text>
    <text x="70" y="157" font-family="'Segoe UI', Arial, sans-serif" font-size="13" fill="#222222">• 7 Puroks of Barangay Dacutan (Purok 1–7)</text>
    <text x="70" y="177" font-family="'Segoe UI', Arial, sans-serif" font-size="13" fill="#222222">• Sector Flags (Senior, PWD, 4Ps, Indigent)</text>

    <!-- Section 2 -->
    <text x="60" y="212" font-family="'Segoe UI', Arial, sans-serif" font-size="14" font-weight="bold" fill="#000000">Document Request &amp; Appointment Data</text>
    <text x="70" y="234" font-family="'Segoe UI', Arial, sans-serif" font-size="13" fill="#222222">• Clearances &amp; Certifications (Ordinance 2020-01)</text>
    <text x="70" y="254" font-family="'Segoe UI', Arial, sans-serif" font-size="13" fill="#222222">• Active Citizen Contact Email Address</text>
    <text x="70" y="274" font-family="'Segoe UI', Arial, sans-serif" font-size="13" fill="#222222">• 4-Digit Email OTP Verification Code</text>

    <!-- Section 3 -->
    <text x="60" y="309" font-family="'Segoe UI', Arial, sans-serif" font-size="14" font-weight="bold" fill="#000000">Barangay Operations Data</text>
    <text x="70" y="331" font-family="'Segoe UI', Arial, sans-serif" font-size="13" fill="#222222">• Lupon Blotter Incidents &amp; Hearing Schedules</text>
    <text x="70" y="351" font-family="'Segoe UI', Arial, sans-serif" font-size="13" fill="#222222">• Calamity Relief &amp; SAP Aid Distributions</text>
    <text x="70" y="371" font-family="'Segoe UI', Arial, sans-serif" font-size="13" fill="#222222">• Official Receipt (OR) &amp; CTC Records</text>

    <!-- Section 4 -->
    <text x="60" y="406" font-family="'Segoe UI', Arial, sans-serif" font-size="14" font-weight="bold" fill="#000000">Administrative Leadership</text>
    <text x="70" y="428" font-family="'Segoe UI', Arial, sans-serif" font-size="13" fill="#222222">• Hon. Stephen James D. Foerster (Punong Barangay)</text>
    <text x="70" y="448" font-family="'Segoe UI', Arial, sans-serif" font-size="13" fill="#222222">• Mrs. Pearl Joy J. Amuan (Barangay Secretary)</text>

    <!-- ==================== 2. PROCESS CONTAINER (Height: 460) ==================== -->
    <rect x="460" y="40" width="360" height="460" rx="6" fill="#FFFFFF" stroke="#000000" stroke-width="2" filter="url(#shadow)"/>
    <!-- Header banner -->
    <rect x="460" y="40" width="360" height="46" rx="6" fill="#F0F0F0" stroke="#000000" stroke-width="2"/>
    <text x="640" y="70" font-family="'Segoe UI', Arial, sans-serif" font-size="18" font-weight="bold" text-anchor="middle" fill="#000000">PROCESS</text>

    <!-- Process Content -->
    <!-- Phase 1 -->
    <text x="480" y="115" font-family="'Segoe UI', Arial, sans-serif" font-size="14" font-weight="bold" fill="#000000">Phase 1: Planning &amp; Analysis</text>
    <text x="490" y="137" font-family="'Segoe UI', Arial, sans-serif" font-size="13" fill="#222222">• Community Needs Assessment in Brgy Dacutan</text>
    <text x="490" y="157" font-family="'Segoe UI', Arial, sans-serif" font-size="13" fill="#222222">• Review of Barangay Ordinance No. 2020-01</text>
    <text x="490" y="177" font-family="'Segoe UI', Arial, sans-serif" font-size="13" fill="#222222">• Hardware, Software, &amp; Network Specifications</text>

    <!-- Phase 2 -->
    <text x="480" y="212" font-family="'Segoe UI', Arial, sans-serif" font-size="14" font-weight="bold" fill="#000000">Phase 2: Prototyping &amp; Development</text>
    <text x="490" y="234" font-family="'Segoe UI', Arial, sans-serif" font-size="13" fill="#222222">• Full-Stack Web Development (Laravel 12 &amp; MySQL)</text>
    <text x="490" y="254" font-family="'Segoe UI', Arial, sans-serif" font-size="13" fill="#222222">• 24/7 Public Citizen Portal &amp; E-Services Desk</text>
    <text x="490" y="274" font-family="'Segoe UI', Arial, sans-serif" font-size="13" fill="#222222">• 4-Digit Email OTP Verification (Spam Elimination)</text>
    <text x="490" y="294" font-family="'Segoe UI', Arial, sans-serif" font-size="13" fill="#222222">• Two-Tier Review Workflow (Secretary &amp; Captain)</text>
    <text x="490" y="314" font-family="'Segoe UI', Arial, sans-serif" font-size="13" fill="#222222">• Automated SMTP Email Notification Dispatcher</text>
    <text x="490" y="334" font-family="'Segoe UI', Arial, sans-serif" font-size="13" fill="#222222">• Dual-Seal Standard A4 Clearance Generator</text>
    <text x="490" y="354" font-family="'Segoe UI', Arial, sans-serif" font-size="13" fill="#222222">• Live 4-Stage Document Progress Tracking Desk</text>

    <!-- Phase 3 -->
    <text x="480" y="389" font-family="'Segoe UI', Arial, sans-serif" font-size="14" font-weight="bold" fill="#000000">Phase 3: Testing &amp; Evaluation</text>
    <text x="490" y="411" font-family="'Segoe UI', Arial, sans-serif" font-size="13" fill="#222222">• Comprehensive Component &amp; Route Testing</text>
    <text x="490" y="431" font-family="'Segoe UI', Arial, sans-serif" font-size="13" fill="#222222">• End-User Pilot Demonstration &amp; Feedback</text>
    <text x="490" y="451" font-family="'Segoe UI', Arial, sans-serif" font-size="13" fill="#222222">• ISO/IEC 25010 Software Quality Evaluation</text>

    <!-- ==================== 3. OUTPUT CONTAINER (Height: 460) ==================== -->
    <rect x="880" y="40" width="360" height="460" rx="6" fill="#FFFFFF" stroke="#000000" stroke-width="2" filter="url(#shadow)"/>
    <!-- Header banner -->
    <rect x="880" y="40" width="360" height="46" rx="6" fill="#F0F0F0" stroke="#000000" stroke-width="2"/>
    <text x="1060" y="70" font-family="'Segoe UI', Arial, sans-serif" font-size="18" font-weight="bold" text-anchor="middle" fill="#000000">OUTPUT</text>

    <!-- Output Content (Centered Vertically, Strictly System Name) -->
    <!-- Decorative Center Icon/Badge -->
    <circle cx="1060" cy="220" r="48" fill="#F8F8F8" stroke="#000000" stroke-width="2"/>
    <!-- Shield / System Icon -->
    <path d="M 1060 188 L 1092 202 L 1092 228 C 1092 248 1060 262 1060 262 C 1060 262 1028 248 1028 228 L 1028 202 Z" fill="#FFFFFF" stroke="#000000" stroke-width="2"/>
    <text x="1060" y="231" font-family="'Segoe UI', Arial, sans-serif" font-size="14" font-weight="bold" text-anchor="middle" fill="#000000">BIMS</text>

    <!-- System Name Text (Prominent, Elegant, Centered) -->
    <text x="1060" y="305" font-family="'Segoe UI', Arial, sans-serif" font-size="20" font-weight="bold" text-anchor="middle" fill="#000000">Barangay Information</text>
    <text x="1060" y="333" font-family="'Segoe UI', Arial, sans-serif" font-size="20" font-weight="bold" text-anchor="middle" fill="#000000">and Management System</text>
    <text x="1060" y="365" font-family="'Segoe UI', Arial, sans-serif" font-size="24" font-weight="bold" text-anchor="middle" fill="#000000">(BIMS)</text>

    <!-- Subtitle tag -->
    <rect x="940" y="395" width="240" height="32" rx="16" fill="#F4F4F4" stroke="#000000" stroke-width="1.2"/>
    <text x="1060" y="416" font-family="'Segoe UI', Arial, sans-serif" font-size="12" font-weight="bold" text-anchor="middle" fill="#333333">OFFICIAL SYSTEM DELIVERABLE</text>

    <!-- ==================== CONNECTING ARROWS (NO TEXT ON LINES) ==================== -->
    <!-- Arrow 1: Input -> Process (Clean straight line) -->
    <line x1="400" y1="270" x2="460" y2="270" stroke="#000000" stroke-width="2.5" marker-end="url(#arrow)"/>

    <!-- Arrow 2: Process -> Output (Clean straight line) -->
    <line x1="820" y1="270" x2="880" y2="270" stroke="#000000" stroke-width="2.5" marker-end="url(#arrow)"/>

    <!-- ==================== 4. FEEDBACK CONTAINER (Bottom, Own Height: 84) ==================== -->
    <rect x="160" y="545" width="960" height="84" rx="6" fill="#FFFFFF" stroke="#000000" stroke-width="2" filter="url(#shadow)"/>
    <text x="640" y="575" font-family="'Segoe UI', Arial, sans-serif" font-size="16" font-weight="bold" text-anchor="middle" fill="#000000">FEEDBACK &amp; CONTINUOUS EVALUATION</text>
    <text x="640" y="605" font-family="'Segoe UI', Arial, sans-serif" font-size="14" text-anchor="middle" fill="#333333">ISO/IEC 25010 Software Quality Evaluation &amp; Frontline Community User Feedback Loop</text>

    <!-- Orthogonal Feedback Arrows (NO TEXT ON LINES) -->
    <!-- Output Bottom -> Feedback Right -->
    <polyline points="1060,500 1060,587 1120,587" fill="none" stroke="#000000" stroke-width="2" marker-end="url(#arrow)"/>

    <!-- Feedback Left -> Input Bottom -->
    <polyline points="160,587 220,587 220,500" fill="none" stroke="#000000" stroke-width="2" marker-end="url(#arrow)"/>
</svg>"""

    with open(svg_path, 'w', encoding='utf-8') as f:
        f.write(svg_content)
    print(f"Generated SVG: {svg_path}")

    # Convert SVG to High-Resolution PNG via Chrome Headless
    cmd = [
        chrome_path,
        '--headless',
        '--disable-gpu',
        f'--screenshot={png_path}',
        '--window-size=1280,660',
        '--force-device-scale-factor=2',
        svg_path
    ]
    subprocess.run(cmd, check=True)
    print(f"Rendered High-Res PNG: {png_path} ({os.path.getsize(png_path)} bytes)")

# ==============================================================================
# 2. GENERATE FIGURE 7: SYSTEM ARCHITECTURE DIAGRAM (SVG -> HIGH-RES PNG)
#    Requirements:
#    - Use actual vector images / SVG icons for every component!
#    - Clear, visually prominent typography
# ==============================================================================
def generate_figure7_svg():
    svg_path = os.path.join(output_dir, "figure7_system_architecture.svg")
    png_path = os.path.join(output_dir, "figure7_system_architecture.png")

    svg_content = """<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1320 920" width="1320" height="920">
    <defs>
        <marker id="arrow7" viewBox="0 0 10 10" refX="8" refY="5" markerWidth="7" markerHeight="7" orient="auto-start-reverse">
            <path d="M 0 1.5 L 8 5 L 0 8.5 z" fill="#000000"/>
        </marker>
        <filter id="shadow7" x="-2%" y="-2%" width="104%" height="104%">
            <feDropShadow dx="2" dy="2" stdDeviation="2" flood-color="#000000" flood-opacity="0.12"/>
        </filter>
    </defs>

    <!-- Background -->
    <rect width="1320" height="920" fill="#FFFFFF"/>

    <!-- ==================== TIER 1: PRESENTATION / CLIENT TIER ==================== -->
    <rect x="40" y="30" width="1240" height="175" rx="8" fill="#FAFAFA" stroke="#000000" stroke-width="2" filter="url(#shadow7)"/>
    <rect x="40" y="30" width="1240" height="34" rx="8" fill="#EAEAEA" stroke="#000000" stroke-width="2"/>
    <text x="60" y="53" font-family="'Segoe UI', Arial, sans-serif" font-size="15" font-weight="bold" fill="#000000">1. PRESENTATION / CLIENT TIER</text>

    <!-- Sub-card 1.1: Public Citizen Access -->
    <rect x="70" y="78" width="560" height="110" rx="6" fill="#FFFFFF" stroke="#000000" stroke-width="1.5"/>
    <!-- Vector Icon: Smartphone -->
    <g transform="translate(90, 94)">
        <rect x="0" y="0" width="34" height="62" rx="5" fill="#FFFFFF" stroke="#000000" stroke-width="2"/>
        <rect x="3" y="6" width="28" height="44" fill="#F0F0F0" stroke="#000000" stroke-width="1"/>
        <circle cx="17" cy="56" r="3" fill="#000000"/>
        <line x1="12" y1="3" x2="22" y2="3" stroke="#000000" stroke-width="1.5" stroke-linecap="round"/>
    </g>
    <!-- Vector Icon: Laptop Computer -->
    <g transform="translate(136, 102)">
        <rect x="6" y="0" width="48" height="34" rx="3" fill="#FFFFFF" stroke="#000000" stroke-width="2"/>
        <rect x="10" y="4" width="40" height="26" fill="#F0F0F0" stroke="#000000" stroke-width="1"/>
        <path d="M 0 34 L 60 34 L 54 44 L 6 44 Z" fill="#E0E0E0" stroke="#000000" stroke-width="2"/>
        <line x1="24" y1="38" x2="36" y2="38" stroke="#000000" stroke-width="1.5"/>
    </g>
    <text x="215" y="108" font-family="'Segoe UI', Arial, sans-serif" font-size="15" font-weight="bold" fill="#000000">Public Citizen Access Portal</text>
    <text x="215" y="130" font-family="'Segoe UI', Arial, sans-serif" font-size="13" fill="#333333">• Responsive Web Browsers (Chrome, Safari, Firefox)</text>
    <text x="215" y="150" font-family="'Segoe UI', Arial, sans-serif" font-size="13" fill="#333333">• Android Smartphones &amp; Apple iOS Devices</text>
    <text x="215" y="170" font-family="'Segoe UI', Arial, sans-serif" font-size="13" fill="#333333">• Laptops, Tablets &amp; Personal Computers</text>

    <!-- Sub-card 1.2: Barangay Hall Workstations -->
    <rect x="680" y="78" width="570" height="110" rx="6" fill="#FFFFFF" stroke="#000000" stroke-width="1.5"/>
    <!-- Vector Icon: Desktop Workstation -->
    <g transform="translate(700, 94)">
        <rect x="0" y="0" width="54" height="40" rx="3" fill="#FFFFFF" stroke="#000000" stroke-width="2"/>
        <rect x="4" y="4" width="46" height="32" fill="#F0F0F0" stroke="#000000" stroke-width="1"/>
        <path d="M 22 40 L 32 40 L 35 50 L 19 50 Z" fill="#CCCCCC" stroke="#000000" stroke-width="1.5"/>
        <line x1="12" y1="50" x2="42" y2="50" stroke="#000000" stroke-width="2.5" stroke-linecap="round"/>
    </g>
    <!-- Vector Icon: Network Laser Printer -->
    <g transform="translate(768, 98)">
        <rect x="4" y="10" width="46" height="28" rx="2" fill="#FFFFFF" stroke="#000000" stroke-width="2"/>
        <rect x="10" y="0" width="34" height="10" fill="#EAEAEA" stroke="#000000" stroke-width="1.5"/>
        <rect x="12" y="26" width="30" height="18" fill="#FFFFFF" stroke="#000000" stroke-width="1.5"/>
        <line x1="16" y1="32" x2="38" y2="32" stroke="#000000" stroke-width="1"/>
        <line x1="16" y1="37" x2="32" y2="37" stroke="#000000" stroke-width="1"/>
        <circle cx="42" cy="18" r="2" fill="#000000"/>
    </g>
    <text x="835" y="108" font-family="'Segoe UI', Arial, sans-serif" font-size="15" font-weight="bold" fill="#000000">Barangay Hall Administrative Terminals</text>
    <text x="835" y="130" font-family="'Segoe UI', Arial, sans-serif" font-size="13" fill="#333333">• Barangay Secretary Desktop Terminal (Records &amp; Clerical)</text>
    <text x="835" y="150" font-family="'Segoe UI', Arial, sans-serif" font-size="13" fill="#333333">• Punong Barangay Executive Oversight Workstation</text>
    <text x="835" y="170" font-family="'Segoe UI', Arial, sans-serif" font-size="13" fill="#333333">• High-Speed Network Laser Printer (Dual-Seal A4 Issuance)</text>

    <!-- Connector: Tier 1 -> Tier 2 -->
    <line x1="660" y1="205" x2="660" y2="250" stroke="#000000" stroke-width="2.5" marker-end="url(#arrow7)"/>
    <text x="670" y="232" font-family="'Segoe UI', Arial, sans-serif" font-size="12" font-weight="bold" fill="#000000">Encrypted HTTPS Traffic (Port 443)</text>

    <!-- ==================== TIER 2: NETWORK & SECURITY TIER ==================== -->
    <rect x="40" y="250" width="1240" height="100" rx="8" fill="#FAFAFA" stroke="#000000" stroke-width="2" filter="url(#shadow7)"/>
    <rect x="40" y="250" width="1240" height="34" rx="8" fill="#EAEAEA" stroke="#000000" stroke-width="2"/>
    <text x="60" y="273" font-family="'Segoe UI', Arial, sans-serif" font-size="15" font-weight="bold" fill="#000000">2. NETWORK &amp; SECURITY TIER</text>

    <!-- Inner content with Vector Icons -->
    <g transform="translate(140, 292)">
        <!-- Vector Icon: Cloud Network -->
        <path d="M 12 28 C 6 28 2 24 2 18 C 2 13 6 9 11 9 C 13 4 19 1 25 1 C 32 1 38 6 39 12 C 43 12 47 16 47 20 C 47 25 43 28 38 28 Z" fill="#FFFFFF" stroke="#000000" stroke-width="2"/>
    </g>
    <g transform="translate(200, 290)">
        <!-- Vector Icon: Security Shield -->
        <path d="M 18 0 L 36 8 L 36 22 C 36 34 18 42 18 42 C 18 42 0 34 0 22 L 0 8 Z" fill="#FFFFFF" stroke="#000000" stroke-width="2"/>
        <!-- Vector Icon: Padlock inside Shield -->
        <rect x="11" y="20" width="14" height="12" rx="2" fill="#000000"/>
        <path d="M 14 20 L 14 15 C 14 12 22 12 22 15 L 22 20" fill="none" stroke="#000000" stroke-width="2"/>
    </g>
    <text x="260" y="315" font-family="'Segoe UI', Arial, sans-serif" font-size="16" font-weight="bold" fill="#000000">Public Internet &amp; Secure HTTPS Protocol (Port 443)</text>
    <text x="260" y="335" font-family="'Segoe UI', Arial, sans-serif" font-size="13" fill="#333333">256-bit SSL / TLS Certificate Encryption • End-to-End Secure Socket Layer Tunneling • Anti-DDoS Mitigation</text>

    <!-- Connector: Tier 2 -> Tier 3 -->
    <line x1="660" y1="350" x2="660" y2="395" stroke="#000000" stroke-width="2.5" marker-end="url(#arrow7)"/>
    <text x="670" y="377" font-family="'Segoe UI', Arial, sans-serif" font-size="12" font-weight="bold" fill="#000000">Secure Web Requests</text>

    <!-- ==================== TIER 3: APPLICATION & SERVICE TIER ==================== -->
    <rect x="40" y="395" width="1240" height="240" rx="8" fill="#FAFAFA" stroke="#000000" stroke-width="2" filter="url(#shadow7)"/>
    <rect x="40" y="395" width="1240" height="34" rx="8" fill="#EAEAEA" stroke="#000000" stroke-width="2"/>
    <text x="60" y="418" font-family="'Segoe UI', Arial, sans-serif" font-size="15" font-weight="bold" fill="#000000">3. APPLICATION &amp; SERVICE TIER (LIVE CLOUD HOSTING ENVIRONMENT)</text>

    <!-- Sub-card 3.1: Web Server Stack -->
    <rect x="70" y="445" width="360" height="170" rx="6" fill="#FFFFFF" stroke="#000000" stroke-width="1.5"/>
    <!-- Vector Icon: Server Rack -->
    <g transform="translate(90, 465)">
        <rect x="0" y="0" width="46" height="18" rx="2" fill="#F8F8F8" stroke="#000000" stroke-width="1.8"/>
        <circle cx="8" cy="9" r="2" fill="#000000"/>
        <line x1="16" y1="9" x2="38" y2="9" stroke="#000000" stroke-width="1.5"/>

        <rect x="0" y="24" width="46" height="18" rx="2" fill="#F8F8F8" stroke="#000000" stroke-width="1.8"/>
        <circle cx="8" cy="33" r="2" fill="#000000"/>
        <line x1="16" y1="33" x2="38" y2="33" stroke="#000000" stroke-width="1.5"/>

        <rect x="0" y="48" width="46" height="18" rx="2" fill="#F8F8F8" stroke="#000000" stroke-width="1.8"/>
        <circle cx="8" cy="57" r="2" fill="#000000"/>
        <line x1="16" y1="57" x2="38" y2="57" stroke="#000000" stroke-width="1.5"/>
    </g>
    <text x="150" y="475" font-family="'Segoe UI', Arial, sans-serif" font-size="15" font-weight="bold" fill="#000000">Web Server Stack</text>
    <text x="90" y="545" font-family="'Segoe UI', Arial, sans-serif" font-size="13" fill="#222222">• Linux OS (Ubuntu 22.04 LTS)</text>
    <text x="90" y="567" font-family="'Segoe UI', Arial, sans-serif" font-size="13" fill="#222222">• Nginx / Apache HTTP Engine</text>
    <text x="90" y="589" font-family="'Segoe UI', Arial, sans-serif" font-size="13" fill="#222222">• PHP 8.2+ FastCGI Process Manager</text>

    <!-- Sub-card 3.2: Laravel Core Application -->
    <rect x="475" y="445" width="370" height="170" rx="6" fill="#FFFFFF" stroke="#000000" stroke-width="1.5"/>
    <!-- Vector Icon: Laravel Core Microchip -->
    <g transform="translate(495, 465)">
        <rect x="6" y="6" width="36" height="36" rx="4" fill="#FFFFFF" stroke="#000000" stroke-width="2"/>
        <!-- Inner core -->
        <rect x="14" y="14" width="20" height="20" fill="#000000"/>
        <!-- Chip pins -->
        <line x1="12" y1="0" x2="12" y2="6" stroke="#000000" stroke-width="2"/>
        <line x1="24" y1="0" x2="24" y2="6" stroke="#000000" stroke-width="2"/>
        <line x1="36" y1="0" x2="36" y2="6" stroke="#000000" stroke-width="2"/>
        <line x1="12" y1="42" x2="12" y2="48" stroke="#000000" stroke-width="2"/>
        <line x1="24" y1="42" x2="24" y2="48" stroke="#000000" stroke-width="2"/>
        <line x1="36" y1="42" x2="36" y2="48" stroke="#000000" stroke-width="2"/>
    </g>
    <text x="555" y="475" font-family="'Segoe UI', Arial, sans-serif" font-size="15" font-weight="bold" fill="#000000">Laravel 12 Application Core</text>
    <text x="495" y="535" font-family="'Segoe UI', Arial, sans-serif" font-size="13" fill="#222222">• HTTP Routing &amp; Role Authentication</text>
    <text x="495" y="555" font-family="'Segoe UI', Arial, sans-serif" font-size="13" fill="#222222">• Eloquent ORM &amp; Relational Business Logic</text>
    <text x="495" y="575" font-family="'Segoe UI', Arial, sans-serif" font-size="13" fill="#222222">• Blade Views &amp; Tailwind CSS UI Engine</text>
    <text x="495" y="595" font-family="'Segoe UI', Arial, sans-serif" font-size="13" fill="#222222">• Two-Tier Clerical/Executive State Machine</text>

    <!-- Sub-card 3.3: Automated Email & OTP Service -->
    <rect x="890" y="445" width="360" height="170" rx="6" fill="#FFFFFF" stroke="#000000" stroke-width="1.5"/>
    <!-- Vector Icon: Mail Envelope with OTP Key Badge -->
    <g transform="translate(910, 465)">
        <rect x="0" y="8" width="46" height="32" rx="3" fill="#FFFFFF" stroke="#000000" stroke-width="2"/>
        <polyline points="0,8 23,26 46,8" fill="none" stroke="#000000" stroke-width="2"/>
        <!-- Circular OTP Badge -->
        <circle cx="38" cy="38" r="12" fill="#FFFFFF" stroke="#000000" stroke-width="2"/>
        <text x="38" y="42" font-family="'Segoe UI', Arial, sans-serif" font-size="10" font-weight="bold" text-anchor="middle" fill="#000000">OTP</text>
    </g>
    <text x="970" y="475" font-family="'Segoe UI', Arial, sans-serif" font-size="15" font-weight="bold" fill="#000000">Messaging &amp; Notification Service</text>
    <text x="910" y="540" font-family="'Segoe UI', Arial, sans-serif" font-size="13" fill="#222222">• Automated 4-Digit Email OTP Generator</text>
    <text x="910" y="562" font-family="'Segoe UI', Arial, sans-serif" font-size="13" fill="#222222">• SMTP Protocol Integration (Port 587 / 465)</text>
    <text x="910" y="584" font-family="'Segoe UI', Arial, sans-serif" font-size="13" fill="#222222">• Real-Time Review &amp; Approval Alert Emails</text>
    <text x="910" y="606" font-family="'Segoe UI', Arial, sans-serif" font-size="13" fill="#222222">• Ready-for-Pickup Instructions Dispatcher</text>

    <!-- Internal Connectors in Tier 3 -->
    <line x1="430" y1="530" x2="475" y2="530" stroke="#000000" stroke-width="2" marker-end="url(#arrow7)"/>
    <line x1="845" y1="530" x2="890" y2="530" stroke="#000000" stroke-width="2" marker-end="url(#arrow7)"/>

    <!-- Connector: Tier 3 -> Tier 4 -->
    <line x1="660" y1="635" x2="660" y2="680" stroke="#000000" stroke-width="2.5" marker-end="url(#arrow7)"/>
    <text x="670" y="662" font-family="'Segoe UI', Arial, sans-serif" font-size="12" font-weight="bold" fill="#000000">SQL Queries &amp; Record Sets (Port 3306)</text>

    <!-- ==================== TIER 4: DATA STORAGE TIER ==================== -->
    <rect x="40" y="680" width="1240" height="205" rx="8" fill="#FAFAFA" stroke="#000000" stroke-width="2" filter="url(#shadow7)"/>
    <rect x="40" y="680" width="1240" height="34" rx="8" fill="#EAEAEA" stroke="#000000" stroke-width="2"/>
    <text x="60" y="703" font-family="'Segoe UI', Arial, sans-serif" font-size="15" font-weight="bold" fill="#000000">4. DATA STORAGE TIER</text>

    <rect x="70" y="728" width="1180" height="142" rx="6" fill="#FFFFFF" stroke="#000000" stroke-width="1.5"/>
    <!-- Vector Icon: Database Cylinder Stack -->
    <g transform="translate(100, 750)">
        <!-- Top Disk -->
        <ellipse cx="26" cy="14" rx="26" ry="10" fill="#F0F0F0" stroke="#000000" stroke-width="2"/>
        <!-- Middle Disk -->
        <path d="M 0 14 L 0 38 C 0 44 26 44 26 44 C 26 44 52 44 52 38 L 52 14" fill="#FFFFFF" stroke="#000000" stroke-width="2"/>
        <path d="M 0 38 C 0 44 26 44 26 44 C 26 44 52 44 52 38" fill="none" stroke="#000000" stroke-width="2"/>
        <!-- Bottom Disk -->
        <path d="M 0 38 L 0 62 C 0 68 26 68 26 68 C 26 68 52 68 52 62 L 52 38" fill="#FFFFFF" stroke="#000000" stroke-width="2"/>
        <path d="M 0 62 C 0 68 26 68 26 68 C 26 68 52 68 52 62" fill="none" stroke="#000000" stroke-width="2"/>
    </g>

    <text x="180" y="760" font-family="'Segoe UI', Arial, sans-serif" font-size="16" font-weight="bold" fill="#000000">MySQL 8.0 Relational DBMS (Community Server)</text>
    <text x="180" y="785" font-family="'Segoe UI', Arial, sans-serif" font-size="13" fill="#222222">• Relational Architecture with Foreign Key Constraints &amp; ACID Transaction Support</text>

    <!-- Table Grid Summary -->
    <rect x="180" y="798" width="180" height="58" rx="4" fill="#F8F8F8" stroke="#000000" stroke-width="1"/>
    <text x="190" y="818" font-family="'Segoe UI', Arial, sans-serif" font-size="12" font-weight="bold" fill="#000000">residents</text>
    <text x="190" y="836" font-family="'Segoe UI', Arial, sans-serif" font-size="11" fill="#444444">2,337 Demographic Profiles</text>
    <text x="190" y="848" font-family="'Segoe UI', Arial, sans-serif" font-size="11" fill="#444444">7 Puroks &amp; Sector Eligibility</text>

    <rect x="375" y="798" width="180" height="58" rx="4" fill="#F8F8F8" stroke="#000000" stroke-width="1"/>
    <text x="385" y="818" font-family="'Segoe UI', Arial, sans-serif" font-size="12" font-weight="bold" fill="#000000">certificates</text>
    <text x="385" y="836" font-family="'Segoe UI', Arial, sans-serif" font-size="11" fill="#444444">12 Document Request Types</text>
    <text x="385" y="848" font-family="'Segoe UI', Arial, sans-serif" font-size="11" fill="#444444">Reference Codes &amp; OR / CTC</text>

    <rect x="570" y="798" width="180" height="58" rx="4" fill="#F8F8F8" stroke="#000000" stroke-width="1"/>
    <text x="580" y="818" font-family="'Segoe UI', Arial, sans-serif" font-size="12" font-weight="bold" fill="#000000">blotter_records</text>
    <text x="580" y="836" font-family="'Segoe UI', Arial, sans-serif" font-size="11" fill="#444444">Incident Complaints &amp; Logs</text>
    <text x="580" y="848" font-family="'Segoe UI', Arial, sans-serif" font-size="11" fill="#444444">Mediation &amp; CFA Issuance</text>

    <rect x="765" y="798" width="180" height="58" rx="4" fill="#F8F8F8" stroke="#000000" stroke-width="1"/>
    <text x="775" y="818" font-family="'Segoe UI', Arial, sans-serif" font-size="12" font-weight="bold" fill="#000000">aid_distributions</text>
    <text x="775" y="836" font-family="'Segoe UI', Arial, sans-serif" font-size="11" fill="#444444">Calamity Relief Operations</text>
    <text x="775" y="848" font-family="'Segoe UI', Arial, sans-serif" font-size="11" fill="#444444">Food Packs &amp; SAP Ayuda</text>

    <rect x="960" y="798" width="180" height="58" rx="4" fill="#F8F8F8" stroke="#000000" stroke-width="1"/>
    <text x="970" y="818" font-family="'Segoe UI', Arial, sans-serif" font-size="12" font-weight="bold" fill="#000000">users</text>
    <text x="970" y="836" font-family="'Segoe UI', Arial, sans-serif" font-size="11" fill="#444444">Role-Based Credentials</text>
    <text x="970" y="848" font-family="'Segoe UI', Arial, sans-serif" font-size="11" fill="#444444">Captain &amp; Secretary Roles</text>
</svg>"""

    with open(svg_path, 'w', encoding='utf-8') as f:
        f.write(svg_content)
    print(f"Generated Vector SVG: {svg_path}")

    # Convert to High-Resolution PNG via Chrome Headless
    cmd = [
        chrome_path,
        '--headless',
        '--disable-gpu',
        f'--screenshot={png_path}',
        '--window-size=1320,920',
        '--force-device-scale-factor=2',
        svg_path
    ]
    subprocess.run(cmd, check=True)
    print(f"Rendered High-Res PNG: {png_path} ({os.path.getsize(png_path)} bytes)")

# ==============================================================================
# 3. GENERATE FIGURES 2, 3, 4, 5, 6 VIA PLANTUML
#    Requirements:
#    - Figure 3 (Use Case): Actors on LEFT (Resident) and RIGHT (Secretary & Captain)!
#    - All diagrams: Clearer texts, increased font sizes!
# ==============================================================================
def generate_plantuml_diagrams():
    p = plantuml.PlantUML(url='http://www.plantuml.com/plantuml/img/')

    BW_SKIN = """
skinparam defaultFontName "Segoe UI"
skinparam defaultFontSize 13
skinparam shadowing false
skinparam monochrome true
skinparam roundCorner 4
skinparam ArrowColor #000000
skinparam ArrowThickness 1.5
skinparam DefaultFontColor #000000
"""

    # --- FIGURE 2: PROTOTYPING MODEL ---
    puml_fig2 = f"""@startuml
{BW_SKIN}
skinparam rectangle {{
    BackgroundColor #FFFFFF
    BorderColor #000000
    BorderThickness 1.8
    FontColor #000000
    FontSize 13
    FontStyle bold
}}

rectangle "1. Requirements\\nGathering & Analysis" as Step1
rectangle "2. Quick Design &\\nSystem Architecture" as Step2
rectangle "3. Prototype\\nDevelopment (BIMS)" as Step3
rectangle "4. End-User\\nDemonstration & Evaluation" as Step4
rectangle "5. Prototype Refinement\\n& Optimization" as Step5
rectangle "6. System Testing &\\nLive Cloud Deployment" as Step6

Step1 -down-> Step2 : " Define User\\n Requirements "
Step2 -down-> Step3 : " System & Database\\n Blueprints "
Step3 -right-> Step4 : " Working Prototype\\n Demonstrations "
Step4 -up-> Step5 : " User Evaluation\\n & Feedback "
Step5 -left-> Step3 : " Code Refinement\\n & Adjustments "
Step4 -down-> Step6 : " Requirements Fully Satisfied\\n & Final Acceptance "

@enduml
"""

    # --- FIGURE 3: USE CASE DIAGRAM (LEFT & RIGHT ACTORS) ---
    puml_fig3 = f"""@startuml
{BW_SKIN}

left to right direction

skinparam actor {{
    BackgroundColor #FFFFFF
    BorderColor #000000
    BorderThickness 1.8
    FontColor #000000
    FontSize 13
    FontStyle bold
}}

skinparam usecase {{
    BackgroundColor #FFFFFF
    BorderColor #000000
    BorderThickness 1.4
    FontColor #000000
    FontSize 12
}}

skinparam package {{
    BackgroundColor #FFFFFF
    BorderColor #000000
    BorderThickness 1.4
    FontColor #000000
    FontSize 13
    FontStyle bold
}}

skinparam rectangle {{
    BackgroundColor #FFFFFF
    BorderColor #000000
    BorderThickness 1.8
    FontColor #000000
    FontSize 14
    FontStyle bold
}}

' ================= ACTOR ON LEFT =================
actor "Resident / Citizen\\n(General Public)" as Resident

' ================= SYSTEM BOUNDARY IN MIDDLE =================
rectangle "Barangay Information and Management System (BIMS)" {{

    package "Public Citizen Frontline Services" as P1 {{
        usecase "View Announcements & Hotlines" as UC1
        usecase "Apply for Clearances / Appointments\\n(12 Official Offerings)" as UC2
        usecase "Verify 4-Digit OTP via Email" as UC2_OTP
        usecase "Track Document Request Status" as UC3
        usecase "Receive Automated Email Notifications" as UC4
    }}

    package "Administrative & Clerical Operations" as P2 {{
        usecase "Manage Resident Profiles & Vulnerabilities" as UC5
        usecase "Review & Evaluate Applications (Tier 1)" as UC6
        usecase "Manage Blotter Records & Hearings" as UC7
        usecase "Log Calamity & SAP Relief Distributions" as UC8
        usecase "Record Official OR & CTC Payments" as UC9
        usecase "Generate & Print Official A4 Clearances" as UC10
    }}

    package "Executive Governance & Oversight" as P3 {{
        usecase "View Executive Analytics Dashboard" as UC11
        usecase "Grant Executive Approval (Tier 2)" as UC12
        usecase "Oversee Lupon Resolutions & Certifications" as UC13
        usecase "Sign & Issue Official Clearances" as UC14
    }}
}}

' ================= ACTORS ON RIGHT =================
actor "Mrs. Pearl Joy J. Amuan\\n(Barangay Secretary & Records Officer)" as Secretary
actor "Hon. Stephen James D. Foerster\\n(Punong Barangay)" as Captain

' Resident Links (Left to Center)
Resident --> UC1
Resident --> UC2
Resident --> UC3
UC2 ..> UC2_OTP : <<include>>
UC2 ..> UC4 : <<include>>

' Staff Links (Right to Center)
UC5 <-- Secretary
UC6 <-- Secretary
UC7 <-- Secretary
UC8 <-- Secretary
UC9 <-- Secretary
UC10 <-- Secretary

UC11 <-- Captain
UC12 <-- Captain
UC13 <-- Captain
UC14 <-- Captain

@enduml
"""

    # --- FIGURE 4: ACTIVITY DIAGRAM ---
    puml_fig4 = f"""@startuml
{BW_SKIN}

skinparam activity {{
    BackgroundColor #FFFFFF
    BorderColor #000000
    BorderThickness 1.4
    FontColor #000000
    FontSize 12
}}

skinparam partition {{
    BackgroundColor #FFFFFF
    BorderColor #000000
    BorderThickness 1.6
    FontColor #000000
    FontSize 13
    FontStyle bold
}}

skinparam condition {{
    BackgroundColor #FFFFFF
    BorderColor #000000
    BorderThickness 1.4
    FontColor #000000
    FontSize 12
}}

|Resident / Citizen|
start
:Access Public Citizen Portal;
:Fill out online request & appointment form\\n(select from official document offerings);
:Enter active email address & request purpose;
:Click "Request 4-Digit Email OTP";

|BIMS Web System & Mailer|
:Validate email address format;
:Generate temporary 4-digit OTP;
:Transmit OTP via automated SMTP email;

|Resident / Citizen|
:Check email inbox for 4-digit OTP;
:Enter 4-digit OTP code into verification field;
:Submit document appointment request;

|BIMS Web System & Mailer|
if (Is OTP code valid?) then (no)
    :Display error message\\n"Invalid or Expired OTP";
    |Resident / Citizen|
    :Re-enter or request new OTP;
    stop
else (yes)
    |BIMS Web System & Mailer|
    :Authenticate genuine applicant\\n(eliminates spam & fake entries);
    :Generate unique tracking reference code\\n(e.g., DAC-2026-XXXX);
    :Record application as "Submitted";
    :Send automated Confirmation Email\\nwith tracking reference code;
endif

|Mrs. Pearl Joy J. Amuan (Barangay Secretary)|
:Log in to Administrative Dashboard;
:Open Pending Request queue;
:Inspect applicant against 2025 Census\\nDemographics & Blotter Records;

if (Application valid & complete?) then (no)
    :Reject application with remarks;
    |BIMS Web System & Mailer|
    :Update status to "Rejected";
    :Send Rejection Notice email;
    |Resident / Citizen|
    :Receive rejection email;
    stop
else (yes)
    |Mrs. Pearl Joy J. Amuan (Barangay Secretary)|
    :Endorse request (Tier 1 completed);
    |BIMS Web System & Mailer|
    :Update status to "Evaluated";
    :Send Evaluation Notice email;
endif

|Hon. Stephen James D. Foerster (Punong Barangay)|
:Access Executive Dashboard;
:Review application in Evaluated queue;

if (Grant Executive Approval?) then (no)
    :Disapprove or request revision;
    |BIMS Web System & Mailer|
    :Update status and send notice email;
    |Resident / Citizen|
    :Receive notification email;
    stop
else (yes)
    |Hon. Stephen James D. Foerster (Punong Barangay)|
    :Authorize executive approval (Tier 2);
    |BIMS Web System & Mailer|
    :Update status to "Approved";
    :Send Captain Approval Notice email;
endif

|Mrs. Pearl Joy J. Amuan (Barangay Secretary)|
:Record Official Receipt (OR) and\\nCommunity Tax Certificate (CTC) numbers;
:Print official Republic standard A4 clearance\\nwith municipal and barangay seals;
:Update status to "Ready for Release";

|BIMS Web System & Mailer|
:Send automated Pickup Notice email with\\npickup instructions and fee schedule;

|Resident / Citizen|
:Receive Ready for Pickup email;
:Visit Barangay Hall;
:Present identification & pay fee in cash;
:Claim signed official A4 clearance;
stop

@enduml
"""

    # --- FIGURE 5: CLASS DIAGRAM ---
    puml_fig5 = f"""@startuml
{BW_SKIN}

skinparam class {{
    BackgroundColor #FFFFFF
    BorderColor #000000
    BorderThickness 1.5
    FontColor #000000
    FontSize 12
    AttributeFontSize 11
    HeaderBackgroundColor #FFFFFF
}}

class BlotterRecord {{
    + id : bigint [PK]
    --
    + blotter_no : varchar(30) [UK]
    + complainant_name : varchar(255)
    + respondent_name : varchar(255)
    + incident_type : varchar(100)
    + incident_location : varchar(255)
    + incident_date : datetime
    + status : enum('in_mediation','settled','dismissed')
    + hearing_date : datetime
    + narrative : text
    + created_by : bigint [FK]
    + created_at : timestamp
    + updated_at : timestamp
}}

class User {{
    + id : bigint [PK]
    --
    + name : varchar(255)
    + email : varchar(255) [UK]
    + role : enum('captain', 'secretary')
    + password : varchar(255)
    + created_at : timestamp
    + updated_at : timestamp
    --
    + evaluateCertificate()
    + approveCertificate()
}}

class Certificate {{
    + id : bigint [PK]
    --
    + reference_no : varchar(20) [UK]
    + resident_id : bigint [FK]
    + doc_type : varchar(100)
    + purpose : text
    + email : varchar(255)
    + status : enum('submitted','evaluated','approved','released','rejected')
    + or_number : varchar(50)
    + ctc_number : varchar(50)
    + fee : decimal(10,2)
    + evaluated_by : bigint [FK]
    + approved_by : bigint [FK]
    + remarks : text
    + created_at : timestamp
    + updated_at : timestamp
}}

class Resident {{
    + id : bigint [PK]
    --
    + first_name : varchar(100)
    + middle_name : varchar(100)
    + last_name : varchar(100)
    + birth_date : date
    + civil_status : enum
    + gender : enum('Male', 'Female')
    + purok : varchar(50)
    + contact_number : varchar(20)
    + is_voter : boolean
    + is_senior : boolean
    + is_pwd : boolean
    + is_indigent : boolean
    + is_4ps : boolean
    + is_solo_parent : boolean
    + created_at : timestamp
    + updated_at : timestamp
    --
    + getFullNameAttribute()
}}

class AidRecipient {{
    + id : bigint [PK]
    --
    + aid_distribution_id : bigint [FK]
    + resident_id : bigint [FK]
    + quantity : int
    + status : enum('claimed','pending')
    + received_at : timestamp
}}

class AidDistribution {{
    + id : bigint [PK]
    --
    + batch_name : varchar(255)
    + aid_type : varchar(100)
    + date_distributed : date
    + notes : text
    + created_by : bigint [FK]
    + created_at : timestamp
    + updated_at : timestamp
}}

User "1" -left-> "0..*" BlotterRecord : encodes >
User "1" -down-> "0..*" Certificate : processes >
Resident "1" -down-> "0..*" Certificate : requests >
Resident "1" -right-> "0..*" AidRecipient : receives >
AidDistribution "1" -down-> "1..*" AidRecipient : contains >
User "1" -down-> "0..*" AidDistribution : creates >

@enduml
"""

    # --- FIGURE 6: SEQUENCE DIAGRAM ---
    puml_fig6 = f"""@startuml
{BW_SKIN}
skinparam sequence {{
    ArrowColor #000000
    ArrowThickness 1.5
    ActorBorderColor #000000
    ActorBorderThickness 1.6
    ActorBackgroundColor #FFFFFF
    ParticipantBorderColor #000000
    ParticipantBorderThickness 1.6
    ParticipantBackgroundColor #FFFFFF
    ParticipantFontSize 12
    ParticipantFontColor #000000
    LifeLineBorderColor #000000
    LifeLineBorderThickness 1.3
    LifeLineBackgroundColor #FFFFFF
}}

skinparam alt {{
    BackgroundColor #FFFFFF
    BorderColor #000000
    BorderThickness 1.6
    FontColor #000000
    FontSize 12
}}

actor "Resident / Citizen" as Resident
boundary "Web Browser\\n(Public Portal)" as Browser
control "Laravel Router\\n(web.php)" as Router
control "PublicPortalController" as Controller
entity "Certificate Model" as Model
database "MySQL 8.0 Database" as DB

Resident -> Browser: 1. Enter 8-character Tracking Code\\n(e.g., CERT-A1B2C3D4) and click "Track"
activate Browser

Browser -> Router: 2. GET /track?reference_no=CERT-A1B2C3D4
activate Router

Router -> Controller: 3. Invoke track(Request $request)
activate Controller

Controller -> Model: 4. where('reference_no', $code)->first()
activate Model

Model -> DB: 5. SELECT * FROM certificates\\nWHERE reference_no = 'CERT-A1B2C3D4' LIMIT 1
activate DB

DB --> Model: 6. Return certificate record row
deactivate DB

Model --> Controller: 7. Return $certificate model instance
deactivate Model

alt Certificate Record Found
    Controller -> Controller: 8. Determine current lifecycle status\\n(Submitted -> Evaluated -> Approved -> Ready for Release)
    Controller --> Browser: 9. HTTP 200 OK (Render Tracking View with Stepper & Timestamps)
    Browser --> Resident: 10. Display 4-Stage Progress Visualizer,\\nStatus Badge, Processing Dates & Pickup Advice
else Certificate Record Not Found / Invalid Code
    Controller --> Browser: 11. HTTP 404 / Redirect with flash('error', 'Tracking code not found')
    Browser --> Resident: 12. Display Alert: "Reference code not found.\\nPlease verify your tracking number."
end

deactivate Controller
deactivate Router
deactivate Browser

@enduml
"""

    plantuml_defs = [
        ("figure2_prototyping_model", puml_fig2),
        ("figure3_use_case_diagram", puml_fig3),
        ("figure4_activity_diagram", puml_fig4),
        ("figure5_class_diagram", puml_fig5),
        ("figure6_sequence_diagram", puml_fig6)
    ]

    for name, content in plantuml_defs:
        puml_path = os.path.join(output_dir, f"{name}.puml")
        png_path = os.path.join(output_dir, f"{name}.png")
        with open(puml_path, 'w', encoding='utf-8') as f:
            f.write(content)
        try:
            png_bytes = p.processes(content)
            with open(png_path, 'wb') as f:
                f.write(png_bytes)
            with Image.open(png_path) as img:
                print(f"Generated: {name}.png | Dimensions: {img.size} | {len(png_bytes)} bytes")
        except Exception as e:
            print(f"Error compiling {name}: {e}")

if __name__ == "__main__":
    print("\n--- 1. Generating Figure 1 (Same Height Containers, No Text on Lines, Large Font) ---")
    generate_figure1_svg()

    print("\n--- 2. Generating Figure 7 (Vector Components, SVG Icons, High-Res PNG) ---")
    generate_figure7_svg()

    print("\n--- 3. Generating Figures 2-6 via PlantUML (Left/Right Actors, Clear Text) ---")
    generate_plantuml_diagrams()

    print("\nAll 7 diagrams generated and synchronized successfully!")

