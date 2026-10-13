import os
import subprocess
import plantuml
from PIL import Image

output_dir = os.path.abspath('Documentation/Diagrams')
os.makedirs(output_dir, exist_ok=True)
chrome_path = r'C:\Program Files\Google\Chrome\Application\chrome.exe'

# ==============================================================================
# 1. GENERATE FIGURE 1: CONCEPTUAL FRAMEWORK (SVG -> HIGH-RES PNG)
#    User Requirements:
#    - "for the conceptual framework.. not vectors or what.. only texts.."
#    - "for system evaluations shoyld be: System Evaluation ( ISO 25010 )"
#    - "output is the name of the system alone.. no many more."
#    - "same heights of the containers.. except the system evaluation.."
#    - "remove texts in the lines."
#    - "visually visible, increase font sizes in the diagram."
# ==============================================================================
def generate_figure1_svg():
    svg_path = os.path.join(output_dir, "figure1_conceptual_framework.svg")
    png_path = os.path.join(output_dir, "figure1_conceptual_framework.png")

    svg_content = """<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1320 680" width="1320" height="680">
    <defs>
        <marker id="arrow1" viewBox="0 0 10 10" refX="8" refY="5" markerWidth="7" markerHeight="7" orient="auto-start-reverse">
            <path d="M 0 1.5 L 8 5 L 0 8.5 z" fill="#000000"/>
        </marker>
        <filter id="shadow1" x="-2%" y="-2%" width="104%" height="104%">
            <feDropShadow dx="2" dy="2" stdDeviation="2" flood-color="#000000" flood-opacity="0.08"/>
        </filter>
    </defs>

    <!-- Canvas Background -->
    <rect width="1320" height="680" fill="#FFFFFF"/>

    <!-- ==================== 1. INPUT CONTAINER (Height: 480) ==================== -->
    <rect x="40" y="40" width="370" height="480" rx="4" fill="#FFFFFF" stroke="#000000" stroke-width="2" filter="url(#shadow1)"/>
    <rect x="40" y="40" width="370" height="48" rx="4" fill="#F2F2F2" stroke="#000000" stroke-width="2"/>
    <text x="225" y="72" font-family="'Segoe UI', Arial, sans-serif" font-size="20" font-weight="bold" text-anchor="middle" fill="#000000">INPUT</text>

    <!-- Section 1 -->
    <text x="60" y="120" font-family="'Segoe UI', Arial, sans-serif" font-size="15" font-weight="bold" fill="#000000">Resident Census Information</text>
    <text x="70" y="143" font-family="'Segoe UI', Arial, sans-serif" font-size="13.5" fill="#111111">• Demographics (Name, Age, Gender, Civil Status)</text>
    <text x="70" y="165" font-family="'Segoe UI', Arial, sans-serif" font-size="13.5" fill="#111111">• 7 Puroks of Barangay Dacutan (Purok 1–7)</text>
    <text x="70" y="187" font-family="'Segoe UI', Arial, sans-serif" font-size="13.5" fill="#111111">• Sector Flags (Senior, PWD, 4Ps, Indigent)</text>

    <!-- Section 2 -->
    <text x="60" y="224" font-family="'Segoe UI', Arial, sans-serif" font-size="15" font-weight="bold" fill="#000000">Document Request &amp; Appointment Data</text>
    <text x="70" y="247" font-family="'Segoe UI', Arial, sans-serif" font-size="13.5" fill="#111111">• Clearances &amp; Certifications (Ordinance 2020-01)</text>
    <text x="70" y="269" font-family="'Segoe UI', Arial, sans-serif" font-size="13.5" fill="#111111">• Active Citizen Contact Email Address</text>
    <text x="70" y="291" font-family="'Segoe UI', Arial, sans-serif" font-size="13.5" fill="#111111">• 4-Digit Email OTP Verification Code</text>

    <!-- Section 3 -->
    <text x="60" y="328" font-family="'Segoe UI', Arial, sans-serif" font-size="15" font-weight="bold" fill="#000000">Barangay Operations Data</text>
    <text x="70" y="351" font-family="'Segoe UI', Arial, sans-serif" font-size="13.5" fill="#111111">• Lupon Blotter Incidents &amp; Hearing Schedules</text>
    <text x="70" y="373" font-family="'Segoe UI', Arial, sans-serif" font-size="13.5" fill="#111111">• Calamity Relief &amp; SAP Aid Distributions</text>
    <text x="70" y="395" font-family="'Segoe UI', Arial, sans-serif" font-size="13.5" fill="#111111">• Official Receipt (OR) &amp; CTC Records</text>

    <!-- Section 4 -->
    <text x="60" y="432" font-family="'Segoe UI', Arial, sans-serif" font-size="15" font-weight="bold" fill="#000000">Administrative Leadership</text>
    <text x="70" y="455" font-family="'Segoe UI', Arial, sans-serif" font-size="13.5" fill="#111111">• Hon. Stephen James D. Foerster (Punong Barangay)</text>
    <text x="70" y="477" font-family="'Segoe UI', Arial, sans-serif" font-size="13.5" fill="#111111">• Mrs. Pearl Joy J. Amuan (Barangay Secretary)</text>

    <!-- ==================== 2. PROCESS CONTAINER (Height: 480) ==================== -->
    <rect x="475" y="40" width="370" height="480" rx="4" fill="#FFFFFF" stroke="#000000" stroke-width="2" filter="url(#shadow1)"/>
    <rect x="475" y="40" width="370" height="48" rx="4" fill="#F2F2F2" stroke="#000000" stroke-width="2"/>
    <text x="660" y="72" font-family="'Segoe UI', Arial, sans-serif" font-size="20" font-weight="bold" text-anchor="middle" fill="#000000">PROCESS</text>

    <!-- Phase 1 -->
    <text x="495" y="120" font-family="'Segoe UI', Arial, sans-serif" font-size="15" font-weight="bold" fill="#000000">Phase 1: Planning &amp; Analysis</text>
    <text x="505" y="143" font-family="'Segoe UI', Arial, sans-serif" font-size="13.5" fill="#111111">• Community Needs Assessment in Brgy Dacutan</text>
    <text x="505" y="165" font-family="'Segoe UI', Arial, sans-serif" font-size="13.5" fill="#111111">• Review of Barangay Ordinance No. 2020-01</text>
    <text x="505" y="187" font-family="'Segoe UI', Arial, sans-serif" font-size="13.5" fill="#111111">• System Architecture &amp; Specification</text>

    <!-- Phase 2 -->
    <text x="495" y="224" font-family="'Segoe UI', Arial, sans-serif" font-size="15" font-weight="bold" fill="#000000">Phase 2: Prototyping &amp; Development</text>
    <text x="505" y="247" font-family="'Segoe UI', Arial, sans-serif" font-size="13.5" fill="#111111">• Full-Stack Web Development (Laravel &amp; MySQL)</text>
    <text x="505" y="269" font-family="'Segoe UI', Arial, sans-serif" font-size="13.5" fill="#111111">• 24/7 Citizen Web Portal &amp; E-Services</text>
    <text x="505" y="291" font-family="'Segoe UI', Arial, sans-serif" font-size="13.5" fill="#111111">• AI Chatbot for Resident Assistance (Gemini API)</text>
    <text x="505" y="313" font-family="'Segoe UI', Arial, sans-serif" font-size="13.5" fill="#111111">• 4-Digit Email OTP Verification (Spam Prevention)</text>
    <text x="505" y="335" font-family="'Segoe UI', Arial, sans-serif" font-size="13.5" fill="#111111">• Two-Tier Review Workflow (Secretary &amp; Captain)</text>
    <text x="505" y="357" font-family="'Segoe UI', Arial, sans-serif" font-size="13.5" fill="#111111">• Automated SMTP Email Notifications</text>
    <text x="505" y="379" font-family="'Segoe UI', Arial, sans-serif" font-size="13.5" fill="#111111">• Dual-Seal Standard A4 Clearance Generator</text>

    <!-- Phase 3 -->
    <text x="495" y="416" font-family="'Segoe UI', Arial, sans-serif" font-size="15" font-weight="bold" fill="#000000">Phase 3: Testing &amp; Evaluation</text>
    <text x="505" y="439" font-family="'Segoe UI', Arial, sans-serif" font-size="13.5" fill="#111111">• Component &amp; Route Integration Testing</text>
    <text x="505" y="461" font-family="'Segoe UI', Arial, sans-serif" font-size="13.5" fill="#111111">• End-User Demonstration &amp; Usability Feedback</text>
    <text x="505" y="483" font-family="'Segoe UI', Arial, sans-serif" font-size="13.5" fill="#111111">• ISO/IEC 25010 Software Quality Evaluation</text>

    <!-- ==================== 3. OUTPUT CONTAINER (Height: 480) ==================== -->
    <rect x="910" y="40" width="370" height="480" rx="4" fill="#FFFFFF" stroke="#000000" stroke-width="2" filter="url(#shadow1)"/>
    <rect x="910" y="40" width="370" height="48" rx="4" fill="#F2F2F2" stroke="#000000" stroke-width="2"/>
    <text x="1095" y="72" font-family="'Segoe UI', Arial, sans-serif" font-size="20" font-weight="bold" text-anchor="middle" fill="#000000">OUTPUT</text>

    <!-- Output Content (ONLY TEXT - Strictly Name of System Alone, Centered) -->
    <text x="1095" y="245" font-family="'Segoe UI', Arial, sans-serif" font-size="22" font-weight="bold" text-anchor="middle" fill="#000000">Barangay Information</text>
    <text x="1095" y="280" font-family="'Segoe UI', Arial, sans-serif" font-size="22" font-weight="bold" text-anchor="middle" fill="#000000">and Management System</text>
    <text x="1095" y="325" font-family="'Segoe UI', Arial, sans-serif" font-size="28" font-weight="bold" text-anchor="middle" fill="#000000">(BIMS)</text>

    <!-- ==================== CONNECTING ARROWS (NO TEXT ON LINES) ==================== -->
    <line x1="410" y1="280" x2="475" y2="280" stroke="#000000" stroke-width="2.5" marker-end="url(#arrow1)"/>
    <line x1="845" y1="280" x2="910" y2="280" stroke="#000000" stroke-width="2.5" marker-end="url(#arrow1)"/>

    <!-- ==================== 4. SYSTEM EVALUATION (Bottom Container) ==================== -->
    <!-- "for system evaluations shoyld be: System Evaluation ( ISO 25010 )" -->
    <rect x="180" y="570" width="960" height="65" rx="4" fill="#FFFFFF" stroke="#000000" stroke-width="2" filter="url(#shadow1)"/>
    <text x="660" y="610" font-family="'Segoe UI', Arial, sans-serif" font-size="18" font-weight="bold" text-anchor="middle" fill="#000000">System Evaluation ( ISO 25010 )</text>

    <!-- Orthogonal Feedback Arrows (NO TEXT ON LINES) -->
    <!-- Output Bottom -> Evaluation Right -->
    <polyline points="1095,520 1095,602 1140,602" fill="none" stroke="#000000" stroke-width="2" marker-end="url(#arrow1)"/>

    <!-- Evaluation Left -> Input Bottom -->
    <polyline points="180,602 225,602 225,520" fill="none" stroke="#000000" stroke-width="2" marker-end="url(#arrow1)"/>
</svg>"""

    with open(svg_path, 'w', encoding='utf-8') as f:
        f.write(svg_content)
    print(f"Generated Figure 1 SVG: {svg_path}")

    cmd = [
        chrome_path,
        '--headless',
        '--disable-gpu',
        f'--screenshot={png_path}',
        '--window-size=1320,680',
        '--force-device-scale-factor=2',
        svg_path
    ]
    subprocess.run(cmd, check=True)
    print(f"Rendered Figure 1 PNG: {png_path} ({os.path.getsize(png_path)} bytes)")

# ==============================================================================
# 2. GENERATE FIGURE 7: SYSTEM ARCHITECTURE DIAGRAM (SVG -> HIGH-RES PNG)
#    User Requirements:
#    - "dont incllude specifics.. like Laravel 12, ubuntu 22.4, etc..."
#    - Use actual vector images / SVG components
#    - Include AI Chatbot Assistance (Gemini API)
#    - Clear, visually readable fonts
# ==============================================================================
def generate_figure7_svg():
    svg_path = os.path.join(output_dir, "figure7_system_architecture.svg")
    png_path = os.path.join(output_dir, "figure7_system_architecture.png")

    svg_content = """<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1340 920" width="1340" height="920">
    <defs>
        <marker id="arrow7" viewBox="0 0 10 10" refX="8" refY="5" markerWidth="7" markerHeight="7" orient="auto-start-reverse">
            <path d="M 0 1.5 L 8 5 L 0 8.5 z" fill="#000000"/>
        </marker>
        <filter id="shadow7" x="-2%" y="-2%" width="104%" height="104%">
            <feDropShadow dx="2" dy="2" stdDeviation="2" flood-color="#000000" flood-opacity="0.1"/>
        </filter>
    </defs>

    <!-- Canvas Background -->
    <rect width="1340" height="920" fill="#FFFFFF"/>

    <!-- ==================== TIER 1: PRESENTATION / CLIENT TIER ==================== -->
    <rect x="40" y="30" width="1260" height="175" rx="6" fill="#FAFAFA" stroke="#000000" stroke-width="2" filter="url(#shadow7)"/>
    <rect x="40" y="30" width="1260" height="34" rx="6" fill="#EAEAEA" stroke="#000000" stroke-width="2"/>
    <text x="60" y="53" font-family="'Segoe UI', Arial, sans-serif" font-size="16" font-weight="bold" fill="#000000">1. PRESENTATION / CLIENT TIER</text>

    <!-- Sub-card 1.1: Public Citizen Access Portal -->
    <rect x="70" y="78" width="570" height="112" rx="4" fill="#FFFFFF" stroke="#000000" stroke-width="1.5"/>
    <!-- Vector Icon: Smartphone -->
    <g transform="translate(90, 96)">
        <rect x="0" y="0" width="34" height="62" rx="5" fill="#FFFFFF" stroke="#000000" stroke-width="2"/>
        <rect x="3" y="6" width="28" height="44" fill="#F0F0F0" stroke="#000000" stroke-width="1"/>
        <circle cx="17" cy="56" r="3" fill="#000000"/>
        <line x1="12" y1="3" x2="22" y2="3" stroke="#000000" stroke-width="1.5" stroke-linecap="round"/>
    </g>
    <!-- Vector Icon: Laptop Computer -->
    <g transform="translate(136, 104)">
        <rect x="6" y="0" width="48" height="34" rx="3" fill="#FFFFFF" stroke="#000000" stroke-width="2"/>
        <rect x="10" y="4" width="40" height="26" fill="#F0F0F0" stroke="#000000" stroke-width="1"/>
        <path d="M 0 34 L 60 34 L 54 44 L 6 44 Z" fill="#E0E0E0" stroke="#000000" stroke-width="2"/>
        <line x1="24" y1="38" x2="36" y2="38" stroke="#000000" stroke-width="1.5"/>
    </g>
    <text x="215" y="108" font-family="'Segoe UI', Arial, sans-serif" font-size="16" font-weight="bold" fill="#000000">Public Citizen Access Portal</text>
    <text x="215" y="132" font-family="'Segoe UI', Arial, sans-serif" font-size="13.5" fill="#222222">• Responsive Web Browsers (Mobile &amp; Desktop)</text>
    <text x="215" y="153" font-family="'Segoe UI', Arial, sans-serif" font-size="13.5" fill="#222222">• Public Clearance E-Services &amp; Status Tracking Desk</text>
    <text x="215" y="174" font-family="'Segoe UI', Arial, sans-serif" font-size="13.5" fill="#222222">• 24/7 AI Chatbot Resident Assistance Portal</text>

    <!-- Sub-card 1.2: Barangay Hall Administrative Workstations -->
    <rect x="690" y="78" width="580" height="112" rx="4" fill="#FFFFFF" stroke="#000000" stroke-width="1.5"/>
    <!-- Vector Icon: Desktop Terminal -->
    <g transform="translate(710, 96)">
        <rect x="0" y="0" width="54" height="40" rx="3" fill="#FFFFFF" stroke="#000000" stroke-width="2"/>
        <rect x="4" y="4" width="46" height="32" fill="#F0F0F0" stroke="#000000" stroke-width="1"/>
        <path d="M 22 40 L 32 40 L 35 50 L 19 50 Z" fill="#CCCCCC" stroke="#000000" stroke-width="1.5"/>
        <line x1="12" y1="50" x2="42" y2="50" stroke="#000000" stroke-width="2.5" stroke-linecap="round"/>
    </g>
    <!-- Vector Icon: Network Laser Printer -->
    <g transform="translate(778, 100)">
        <rect x="4" y="10" width="46" height="28" rx="2" fill="#FFFFFF" stroke="#000000" stroke-width="2"/>
        <rect x="10" y="0" width="34" height="10" fill="#EAEAEA" stroke="#000000" stroke-width="1.5"/>
        <rect x="12" y="26" width="30" height="18" fill="#FFFFFF" stroke="#000000" stroke-width="1.5"/>
        <line x1="16" y1="32" x2="38" y2="32" stroke="#000000" stroke-width="1"/>
        <line x1="16" y1="37" x2="32" y2="37" stroke="#000000" stroke-width="1"/>
        <circle cx="42" cy="18" r="2" fill="#000000"/>
    </g>
    <text x="845" y="108" font-family="'Segoe UI', Arial, sans-serif" font-size="16" font-weight="bold" fill="#000000">Barangay Hall Administrative Terminals</text>
    <text x="845" y="132" font-family="'Segoe UI', Arial, sans-serif" font-size="13.5" fill="#222222">• Secretary Desktop Terminal (Census &amp; Clerical Records)</text>
    <text x="845" y="153" font-family="'Segoe UI', Arial, sans-serif" font-size="13.5" fill="#222222">• Punong Barangay Executive Oversight Workstation</text>
    <text x="845" y="174" font-family="'Segoe UI', Arial, sans-serif" font-size="13.5" fill="#222222">• Network Laser Printer (Dual-Seal Official A4 Clearances)</text>

    <!-- Connector: Tier 1 -> Tier 2 -->
    <line x1="670" y1="205" x2="670" y2="248" stroke="#000000" stroke-width="2.5" marker-end="url(#arrow7)"/>
    <text x="680" y="232" font-family="'Segoe UI', Arial, sans-serif" font-size="13" font-weight="bold" fill="#000000">Encrypted HTTPS Protocol (Port 443)</text>

    <!-- ==================== TIER 2: NETWORK & SECURITY TIER ==================== -->
    <rect x="40" y="248" width="1260" height="98" rx="6" fill="#FAFAFA" stroke="#000000" stroke-width="2" filter="url(#shadow7)"/>
    <rect x="40" y="248" width="1260" height="34" rx="6" fill="#EAEAEA" stroke="#000000" stroke-width="2"/>
    <text x="60" y="271" font-family="'Segoe UI', Arial, sans-serif" font-size="16" font-weight="bold" fill="#000000">2. NETWORK &amp; SECURITY TIER</text>

    <!-- Vector Icon: Cloud & Shield -->
    <g transform="translate(140, 290)">
        <path d="M 12 28 C 6 28 2 24 2 18 C 2 13 6 9 11 9 C 13 4 19 1 25 1 C 32 1 38 6 39 12 C 43 12 47 16 47 20 C 47 25 43 28 38 28 Z" fill="#FFFFFF" stroke="#000000" stroke-width="2"/>
    </g>
    <g transform="translate(200, 288)">
        <path d="M 18 0 L 36 8 L 36 22 C 36 34 18 42 18 42 C 18 42 0 34 0 22 L 0 8 Z" fill="#FFFFFF" stroke="#000000" stroke-width="2"/>
        <rect x="11" y="20" width="14" height="12" rx="2" fill="#000000"/>
        <path d="M 14 20 L 14 15 C 14 12 22 12 22 15 L 22 20" fill="none" stroke="#000000" stroke-width="2"/>
    </g>
    <text x="260" y="312" font-family="'Segoe UI', Arial, sans-serif" font-size="16.5" font-weight="bold" fill="#000000">Public Internet &amp; Secure HTTPS Protocol</text>
    <text x="260" y="333" font-family="'Segoe UI', Arial, sans-serif" font-size="13.5" fill="#333333">SSL / TLS Certificate Encryption • End-to-End Encrypted Citizen Traffic • Automated Firewall &amp; CSRF Protection</text>

    <!-- Connector: Tier 2 -> Tier 3 -->
    <line x1="670" y1="346" x2="670" y2="390" stroke="#000000" stroke-width="2.5" marker-end="url(#arrow7)"/>
    <text x="680" y="373" font-family="'Segoe UI', Arial, sans-serif" font-size="13" font-weight="bold" fill="#000000">Secure Web Application Requests</text>

    <!-- ==================== TIER 3: APPLICATION & SERVICE TIER ==================== -->
    <rect x="40" y="390" width="1260" height="248" rx="6" fill="#FAFAFA" stroke="#000000" stroke-width="2" filter="url(#shadow7)"/>
    <rect x="40" y="390" width="1260" height="34" rx="6" fill="#EAEAEA" stroke="#000000" stroke-width="2"/>
    <text x="60" y="413" font-family="'Segoe UI', Arial, sans-serif" font-size="16" font-weight="bold" fill="#000000">3. APPLICATION &amp; SERVICE TIER (LIVE CLOUD HOSTING ENVIRONMENT)</text>

    <!-- Sub-card 3.1: Web Server Stack (No Version Numbers) -->
    <rect x="65" y="440" width="290" height="182" rx="4" fill="#FFFFFF" stroke="#000000" stroke-width="1.5"/>
    <!-- Vector Icon: Server Rack -->
    <g transform="translate(80, 458)">
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
    <text x="138" y="472" font-family="'Segoe UI', Arial, sans-serif" font-size="15" font-weight="bold" fill="#000000">Web Server Stack</text>
    <text x="80" y="538" font-family="'Segoe UI', Arial, sans-serif" font-size="13" fill="#222222">• Linux Server Operating System</text>
    <text x="80" y="560" font-family="'Segoe UI', Arial, sans-serif" font-size="13" fill="#222222">• High-Performance HTTP Engine</text>
    <text x="80" y="582" font-family="'Segoe UI', Arial, sans-serif" font-size="13" fill="#222222">• FastCGI Process Manager</text>
    <text x="80" y="604" font-family="'Segoe UI', Arial, sans-serif" font-size="13" fill="#222222">• Secure Socket Layer Gateway</text>

    <!-- Sub-card 3.2: Application Core Engine (No Version Numbers) -->
    <rect x="370" y="440" width="320" height="182" rx="4" fill="#FFFFFF" stroke="#000000" stroke-width="1.5"/>
    <!-- Vector Icon: Application Core -->
    <g transform="translate(385, 458)">
        <rect x="6" y="6" width="36" height="36" rx="4" fill="#FFFFFF" stroke="#000000" stroke-width="2"/>
        <rect x="14" y="14" width="20" height="20" fill="#000000"/>
        <line x1="12" y1="0" x2="12" y2="6" stroke="#000000" stroke-width="2"/>
        <line x1="24" y1="0" x2="24" y2="6" stroke="#000000" stroke-width="2"/>
        <line x1="36" y1="0" x2="36" y2="6" stroke="#000000" stroke-width="2"/>
        <line x1="12" y1="42" x2="12" y2="48" stroke="#000000" stroke-width="2"/>
        <line x1="24" y1="42" x2="24" y2="48" stroke="#000000" stroke-width="2"/>
        <line x1="36" y1="42" x2="36" y2="48" stroke="#000000" stroke-width="2"/>
    </g>
    <text x="445" y="472" font-family="'Segoe UI', Arial, sans-serif" font-size="15" font-weight="bold" fill="#000000">Core Application Engine</text>
    <text x="385" y="530" font-family="'Segoe UI', Arial, sans-serif" font-size="13" fill="#222222">• MVC Architecture &amp; Business Logic</text>
    <text x="385" y="552" font-family="'Segoe UI', Arial, sans-serif" font-size="13" fill="#222222">• HTTP Routing &amp; Role Authentication</text>
    <text x="385" y="574" font-family="'Segoe UI', Arial, sans-serif" font-size="13" fill="#222222">• Relational Object-Relational Mapping (ORM)</text>
    <text x="385" y="596" font-family="'Segoe UI', Arial, sans-serif" font-size="13" fill="#222222">• Two-Tier Review Approval Workflow Engine</text>

    <!-- Sub-card 3.3: Automated Email & OTP Service -->
    <rect x="705" y="440" width="295" height="182" rx="4" fill="#FFFFFF" stroke="#000000" stroke-width="1.5"/>
    <!-- Vector Icon: Mail with OTP Badge -->
    <g transform="translate(720, 458)">
        <rect x="0" y="8" width="44" height="30" rx="3" fill="#FFFFFF" stroke="#000000" stroke-width="2"/>
        <polyline points="0,8 22,24 44,8" fill="none" stroke="#000000" stroke-width="2"/>
        <circle cx="36" cy="36" r="11" fill="#FFFFFF" stroke="#000000" stroke-width="2"/>
        <text x="36" y="40" font-family="'Segoe UI', Arial, sans-serif" font-size="9" font-weight="bold" text-anchor="middle" fill="#000000">OTP</text>
    </g>
    <text x="778" y="472" font-family="'Segoe UI', Arial, sans-serif" font-size="15" font-weight="bold" fill="#000000">Email &amp; OTP Service</text>
    <text x="720" y="530" font-family="'Segoe UI', Arial, sans-serif" font-size="13" fill="#222222">• 4-Digit Email OTP Generator</text>
    <text x="720" y="552" font-family="'Segoe UI', Arial, sans-serif" font-size="13" fill="#222222">• SMTP Protocol Mail Dispatcher</text>
    <text x="720" y="574" font-family="'Segoe UI', Arial, sans-serif" font-size="13" fill="#222222">• Real-Time Review &amp; Approval Notices</text>
    <text x="720" y="596" font-family="'Segoe UI', Arial, sans-serif" font-size="13" fill="#222222">• Ready-for-Pickup Instructions Alert</text>

    <!-- Sub-card 3.4: AI Chatbot Assistance Service (Gemini API) -->
    <rect x="1015" y="440" width="265" height="182" rx="4" fill="#FFFFFF" stroke="#000000" stroke-width="1.5"/>
    <!-- Vector Icon: AI Chatbot Sparkle / Brain -->
    <g transform="translate(1030, 458)">
        <rect x="4" y="8" width="40" height="32" rx="6" fill="#FFFFFF" stroke="#000000" stroke-width="2"/>
        <circle cx="16" cy="22" r="3.5" fill="#000000"/>
        <circle cx="32" cy="22" r="3.5" fill="#000000"/>
        <path d="M 18 30 Q 24 35 30 30" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round"/>
        <!-- Antenna -->
        <line x1="24" y1="0" x2="24" y2="8" stroke="#000000" stroke-width="2"/>
        <circle cx="24" cy="0" r="3" fill="#000000"/>
    </g>
    <text x="1085" y="472" font-family="'Segoe UI', Arial, sans-serif" font-size="15" font-weight="bold" fill="#000000">AI Chatbot Assistant</text>
    <text x="1030" y="530" font-family="'Segoe UI', Arial, sans-serif" font-size="13" fill="#222222">• Google Gemini API Integration</text>
    <text x="1030" y="552" font-family="'Segoe UI', Arial, sans-serif" font-size="13" fill="#222222">• 24/7 Citizen Conversational Guide</text>
    <text x="1030" y="574" font-family="'Segoe UI', Arial, sans-serif" font-size="13" fill="#222222">• Automated FAQ &amp; Ordinance Advisor</text>
    <text x="1030" y="596" font-family="'Segoe UI', Arial, sans-serif" font-size="13" fill="#222222">• Step-by-Step Filing Assistant</text>

    <!-- Connectors inside Tier 3 -->
    <line x1="355" y1="530" x2="370" y2="530" stroke="#000000" stroke-width="2" marker-end="url(#arrow7)"/>
    <line x1="690" y1="530" x2="705" y2="530" stroke="#000000" stroke-width="2" marker-end="url(#arrow7)"/>
    <line x1="690" y1="570" x2="1015" y2="570" stroke="#000000" stroke-width="2" marker-end="url(#arrow7)"/>

    <!-- Connector: Tier 3 -> Tier 4 -->
    <line x1="670" y1="638" x2="670" y2="682" stroke="#000000" stroke-width="2.5" marker-end="url(#arrow7)"/>
    <text x="680" y="665" font-family="'Segoe UI', Arial, sans-serif" font-size="13" font-weight="bold" fill="#000000">Database Queries &amp; Relational Datasets</text>

    <!-- ==================== TIER 4: DATA STORAGE TIER ==================== -->
    <rect x="40" y="682" width="1260" height="205" rx="6" fill="#FAFAFA" stroke="#000000" stroke-width="2" filter="url(#shadow7)"/>
    <rect x="40" y="682" width="1260" height="34" rx="6" fill="#EAEAEA" stroke="#000000" stroke-width="2"/>
    <text x="60" y="705" font-family="'Segoe UI', Arial, sans-serif" font-size="16" font-weight="bold" fill="#000000">4. DATA STORAGE TIER</text>

    <rect x="70" y="728" width="1200" height="145" rx="4" fill="#FFFFFF" stroke="#000000" stroke-width="1.5"/>
    <!-- Vector Icon: Database Cylinder Stack -->
    <g transform="translate(100, 752)">
        <ellipse cx="26" cy="14" rx="26" ry="10" fill="#F0F0F0" stroke="#000000" stroke-width="2"/>
        <path d="M 0 14 L 0 38 C 0 44 26 44 26 44 C 26 44 52 44 52 38 L 52 14" fill="#FFFFFF" stroke="#000000" stroke-width="2"/>
        <path d="M 0 38 C 0 44 26 44 26 44 C 26 44 52 44 52 38" fill="none" stroke="#000000" stroke-width="2"/>
        <path d="M 0 38 L 0 62 C 0 68 26 68 26 68 C 26 68 52 68 52 62 L 52 38" fill="#FFFFFF" stroke="#000000" stroke-width="2"/>
        <path d="M 0 62 C 0 68 26 68 26 68 C 26 68 52 68 52 62" fill="none" stroke="#000000" stroke-width="2"/>
    </g>

    <text x="180" y="760" font-family="'Segoe UI', Arial, sans-serif" font-size="16.5" font-weight="bold" fill="#000000">Relational Database Management System (RDBMS)</text>
    <text x="180" y="784" font-family="'Segoe UI', Arial, sans-serif" font-size="13.5" fill="#222222">• Normalized Schema Architecture with Foreign Key Integrity &amp; ACID Transaction Support</text>

    <!-- Table Grid Summary (No version numbers) -->
    <rect x="180" y="798" width="185" height="60" rx="4" fill="#F8F8F8" stroke="#000000" stroke-width="1"/>
    <text x="190" y="818" font-family="'Segoe UI', Arial, sans-serif" font-size="13" font-weight="bold" fill="#000000">residents</text>
    <text x="190" y="836" font-family="'Segoe UI', Arial, sans-serif" font-size="12" fill="#444444">2,337 Master Profiles</text>
    <text x="190" y="850" font-family="'Segoe UI', Arial, sans-serif" font-size="12" fill="#444444">7 Puroks &amp; Sector Tags</text>

    <rect x="385" y="798" width="185" height="60" rx="4" fill="#F8F8F8" stroke="#000000" stroke-width="1"/>
    <text x="395" y="818" font-family="'Segoe UI', Arial, sans-serif" font-size="13" font-weight="bold" fill="#000000">certificates</text>
    <text x="395" y="836" font-family="'Segoe UI', Arial, sans-serif" font-size="12" fill="#444444">12 Document Requests</text>
    <text x="395" y="850" font-family="'Segoe UI', Arial, sans-serif" font-size="12" fill="#444444">Reference Tracking &amp; OR/CTC</text>

    <rect x="590" y="798" width="185" height="60" rx="4" fill="#F8F8F8" stroke="#000000" stroke-width="1"/>
    <text x="600" y="818" font-family="'Segoe UI', Arial, sans-serif" font-size="13" font-weight="bold" fill="#000000">blotter_records</text>
    <text x="600" y="836" font-family="'Segoe UI', Arial, sans-serif" font-size="12" fill="#444444">Incident Complaints &amp; Logs</text>
    <text x="600" y="850" font-family="'Segoe UI', Arial, sans-serif" font-size="12" fill="#444444">Mediation &amp; CFA Issuance</text>

    <rect x="795" y="798" width="185" height="60" rx="4" fill="#F8F8F8" stroke="#000000" stroke-width="1"/>
    <text x="805" y="818" font-family="'Segoe UI', Arial, sans-serif" font-size="13" font-weight="bold" fill="#000000">aid_distributions</text>
    <text x="805" y="836" font-family="'Segoe UI', Arial, sans-serif" font-size="12" fill="#444444">Relief Goods Operations</text>
    <text x="805" y="850" font-family="'Segoe UI', Arial, sans-serif" font-size="12" fill="#444444">Food Packs &amp; SAP Ayuda</text>

    <rect x="1000" y="798" width="185" height="60" rx="4" fill="#F8F8F8" stroke="#000000" stroke-width="1"/>
    <text x="1010" y="818" font-family="'Segoe UI', Arial, sans-serif" font-size="13" font-weight="bold" fill="#000000">users</text>
    <text x="1010" y="836" font-family="'Segoe UI', Arial, sans-serif" font-size="12" fill="#444444">Role-Based Credentials</text>
    <text x="1010" y="850" font-family="'Segoe UI', Arial, sans-serif" font-size="12" fill="#444444">Captain &amp; Secretary Roles</text>
</svg>"""

    with open(svg_path, 'w', encoding='utf-8') as f:
        f.write(svg_content)
    print(f"Generated Figure 7 SVG: {svg_path}")

    cmd = [
        chrome_path,
        '--headless',
        '--disable-gpu',
        f'--screenshot={png_path}',
        '--window-size=1340,920',
        '--force-device-scale-factor=2',
        svg_path
    ]
    subprocess.run(cmd, check=True)
    print(f"Rendered Figure 7 PNG: {png_path} ({os.path.getsize(png_path)} bytes)")

# ==============================================================================
# 3. GENERATE FIGURES 2, 3, 4, 5, 6 VIA PLANTUML
#    User Requirements:
#    - Figure 3 (Use Case): Packages INLINE horizontally, proportionate height,
#      actors inline on left and right, includes AI Chatbot Assistance!
#    - Increased font sizes across all diagrams for readability!
# ==============================================================================
def generate_plantuml_diagrams():
    p = plantuml.PlantUML(url='http://www.plantuml.com/plantuml/img/')

    # --- FIGURE 2: PROTOTYPING MODEL (LARGE FONTS) ---
    puml_fig2 = """@startuml
skinparam defaultFontName "Segoe UI"
skinparam defaultFontSize 16
skinparam shadowing false
skinparam monochrome true
skinparam roundCorner 4
skinparam ArrowColor #000000
skinparam ArrowThickness 2.0
skinparam DefaultFontColor #000000

skinparam rectangle {
    BackgroundColor #FFFFFF
    BorderColor #000000
    BorderThickness 2.2
    FontColor #000000
    FontSize 16
    FontStyle bold
}

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

@enduml"""

    # --- FIGURE 3: USE CASE DIAGRAM (INLINE PACKAGES, PROPORTIONATE HEIGHT, LARGE FONTS) ---
    puml_fig3 = """@startuml
skinparam defaultFontName "Segoe UI"
skinparam defaultFontSize 15
skinparam shadowing false
skinparam monochrome true
skinparam packageFontSize 16
skinparam packageFontStyle bold
skinparam usecaseFontSize 14
skinparam actorFontSize 15
skinparam actorFontStyle bold
skinparam ArrowThickness 1.8
skinparam ArrowColor #000000

left to right direction

actor "Resident / Citizen\\n(General Public)" as Resident

rectangle "Barangay Information and Management System (BIMS)" {

    package "Public Citizen Frontline Services" as P1 {
        usecase "View Announcements & Hotlines" as UC1
        usecase "Consult AI Chatbot for Assistance\\n(Google Gemini API)" as UC_AI
        usecase "Apply for Clearances / Appointments\\n(12 Official Offerings)" as UC2
        usecase "Verify 4-Digit OTP via Email" as UC2_OTP
        usecase "Track Document Request Status" as UC3
        usecase "Receive Automated Email Notifications" as UC4
    }

    package "Administrative & Clerical Operations" as P2 {
        usecase "Manage Resident Profiles & Census" as UC5
        usecase "Review & Evaluate Requests (Tier 1)" as UC6
        usecase "Manage Blotter Records & Hearings" as UC7
        usecase "Log Calamity & SAP Relief Aid" as UC8
        usecase "Record Official OR & CTC Payments" as UC9
        usecase "Generate & Print Official A4 Clearances" as UC10
    }

    package "Executive Governance & Oversight" as P3 {
        usecase "View Executive Analytics Dashboard" as UC11
        usecase "Grant Executive Approval (Tier 2)" as UC12
        usecase "Oversee Lupon Dispute Resolutions" as UC13
        usecase "Sign & Issue Official Clearances" as UC14
    }

    ' Place packages horizontally side-by-side to consume space and keep height proportionate
    P1 -[hidden]right- P2
    P2 -[hidden]right- P3
}

actor "Mrs. Pearl Joy J. Amuan\\n(Barangay Secretary & Records Officer)" as Secretary
actor "Hon. Stephen James D. Foerster\\n(Punong Barangay)" as Captain

' Resident on Left
Resident --> UC1
Resident --> UC_AI
Resident --> UC2
Resident --> UC3
UC2 ..> UC2_OTP : <<include>>
UC2 ..> UC4 : <<include>>

' Staff on Right
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

@enduml"""

    # --- FIGURE 4: ACTIVITY DIAGRAM (LARGE FONTS) ---
    puml_fig4 = """@startuml
skinparam defaultFontName "Segoe UI"
skinparam defaultFontSize 14
skinparam shadowing false
skinparam monochrome true
skinparam ArrowColor #000000
skinparam ArrowThickness 1.8
skinparam DefaultFontColor #000000

skinparam activity {
    BackgroundColor #FFFFFF
    BorderColor #000000
    BorderThickness 1.8
    FontColor #000000
    FontSize 14
}

skinparam partition {
    BackgroundColor #FFFFFF
    BorderColor #000000
    BorderThickness 2.0
    FontColor #000000
    FontSize 15
    FontStyle bold
}

skinparam condition {
    BackgroundColor #FFFFFF
    BorderColor #000000
    BorderThickness 1.8
    FontColor #000000
    FontSize 14
}

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

@enduml"""

    # --- FIGURE 5: CLASS DIAGRAM (LARGE FONTS) ---
    puml_fig5 = """@startuml
skinparam defaultFontName "Segoe UI"
skinparam defaultFontSize 14
skinparam shadowing false
skinparam monochrome true
skinparam ArrowColor #000000
skinparam ArrowThickness 1.8

skinparam class {
    BackgroundColor #FFFFFF
    BorderColor #000000
    BorderThickness 1.8
    FontColor #000000
    FontSize 15
    FontStyle bold
    AttributeFontSize 13
    HeaderBackgroundColor #FFFFFF
}

class BlotterRecord {
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
}

class User {
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
}

class Certificate {
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
}

class Resident {
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
}

class AidRecipient {
    + id : bigint [PK]
    --
    + aid_distribution_id : bigint [FK]
    + resident_id : bigint [FK]
    + quantity : int
    + status : enum('claimed','pending')
    + received_at : timestamp
}

class AidDistribution {
    + id : bigint [PK]
    --
    + batch_name : varchar(255)
    + aid_type : varchar(100)
    + date_distributed : date
    + notes : text
    + created_by : bigint [FK]
    + created_at : timestamp
    + updated_at : timestamp
}

User "1" -left-> "0..*" BlotterRecord : encodes >
User "1" -down-> "0..*" Certificate : processes >
Resident "1" -down-> "0..*" Certificate : requests >
Resident "1" -right-> "0..*" AidRecipient : receives >
AidDistribution "1" -down-> "1..*" AidRecipient : contains >
User "1" -down-> "0..*" AidDistribution : creates >

@enduml"""

    # --- FIGURE 6: SEQUENCE DIAGRAM (LARGE FONTS) ---
    puml_fig6 = """@startuml
skinparam defaultFontName "Segoe UI"
skinparam defaultFontSize 14
skinparam shadowing false
skinparam monochrome true
skinparam sequence {
    ArrowColor #000000
    ArrowThickness 1.8
    ActorBorderColor #000000
    ActorBorderThickness 1.8
    ActorBackgroundColor #FFFFFF
    ParticipantBorderColor #000000
    ParticipantBorderThickness 1.8
    ParticipantBackgroundColor #FFFFFF
    ParticipantFontSize 15
    ParticipantFontStyle bold
    ParticipantFontColor #000000
    LifeLineBorderColor #000000
    LifeLineBorderThickness 1.4
    LifeLineBackgroundColor #FFFFFF
}

skinparam alt {
    BackgroundColor #FFFFFF
    BorderColor #000000
    BorderThickness 1.8
    FontColor #000000
    FontSize 14
    FontStyle bold
}

actor "Resident / Citizen" as Resident
boundary "Web Browser\\n(Public Portal)" as Browser
control "Laravel Router\\n(web.php)" as Router
control "PublicPortalController" as Controller
entity "Certificate Model" as Model
database "MySQL Relational DB" as DB

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

@enduml"""

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
                print(f"Generated PlantUML: {name}.png | Dimensions: {img.size} | {len(png_bytes)} bytes")
        except Exception as e:
            print(f"Error compiling {name}: {e}")

if __name__ == "__main__":
    print("\n--- 1. Generating Figure 1 (Only Texts, System Evaluation ( ISO 25010 ), Name Alone) ---")
    generate_figure1_svg()

    print("\n--- 2. Generating Figure 7 (No Version Specifics, Vector Components, AI Chatbot) ---")
    generate_figure7_svg()

    print("\n--- 3. Generating Figures 2-6 (Inline Packages Fig 3, High-Font Fig 2,4,5,6) ---")
    generate_plantuml_diagrams()

    print("\nAll 7 upgraded diagrams successfully generated!")

