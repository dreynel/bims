import os
import subprocess
from PIL import Image

output_dir = os.path.abspath('Documentation/Diagrams')
chrome_path = r'C:\Program Files\Google\Chrome\Application\chrome.exe'

def generate_figure3_svg():
    svg_path = os.path.join(output_dir, "figure3_use_case_diagram.svg")
    png_path = os.path.join(output_dir, "figure3_use_case_diagram.png")

    svg_content = """<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1560 690" width="1560" height="690">
    <defs>
        <marker id="arrow3" viewBox="0 0 10 10" refX="8" refY="5" markerWidth="6" markerHeight="6" orient="auto-start-reverse">
            <path d="M 0 1.5 L 8 5 L 0 8.5 z" fill="#000000"/>
        </marker>
        <filter id="shadow3" x="-2%" y="-2%" width="104%" height="104%">
            <feDropShadow dx="2" dy="2" stdDeviation="2" flood-color="#000000" flood-opacity="0.08"/>
        </filter>
    </defs>

    <!-- Background -->
    <rect width="1560" height="690" fill="#FFFFFF"/>

    <!-- ==================== LEFT ACTOR: RESIDENT ==================== -->
    <g transform="translate(85, 290)">
        <!-- Stick figure actor -->
        <circle cx="0" cy="-45" r="14" fill="#FFFFFF" stroke="#000000" stroke-width="2.2"/>
        <line x1="0" y1="-31" x2="0" y2="10" stroke="#000000" stroke-width="2.2"/>
        <line x1="-24" y1="-18" x2="24" y2="-18" stroke="#000000" stroke-width="2.2"/>
        <line x1="0" y1="10" x2="-18" y2="40" stroke="#000000" stroke-width="2.2"/>
        <line x1="0" y1="10" x2="18" y2="40" stroke="#000000" stroke-width="2.2"/>
        <!-- Text label -->
        <text x="0" y="62" font-family="'Segoe UI', Arial, sans-serif" font-size="14.5" font-weight="bold" text-anchor="middle" fill="#000000">Resident / Citizen</text>
        <text x="0" y="80" font-family="'Segoe UI', Arial, sans-serif" font-size="13" text-anchor="middle" fill="#333333">(General Public)</text>
    </g>

    <!-- ==================== SYSTEM BOUNDARY (CENTER, PROPORTIONATE) ==================== -->
    <rect x="200" y="25" width="1150" height="640" rx="6" fill="#FAFAFA" stroke="#000000" stroke-width="2.2" filter="url(#shadow3)"/>
    <!-- System Title Banner -->
    <rect x="200" y="25" width="1150" height="42" rx="6" fill="#EBEBEB" stroke="#000000" stroke-width="2.2"/>
    <text x="775" y="53" font-family="'Segoe UI', Arial, sans-serif" font-size="17" font-weight="bold" text-anchor="middle" fill="#000000">Barangay Information and Management System (BIMS)</text>

    <!-- ==================== INLINE PACKAGE 1: CITIZEN SERVICES (LEFT) ==================== -->
    <g transform="translate(225, 85)">
        <!-- Tab -->
        <path d="M 0 0 L 170 0 L 180 18 L 0 18 Z" fill="#E0E0E0" stroke="#000000" stroke-width="1.8"/>
        <text x="10" y="14" font-family="'Segoe UI', Arial, sans-serif" font-size="12" font-weight="bold" fill="#000000">Citizen Frontline Services</text>
        <!-- Package body -->
        <rect x="0" y="18" width="355" height="545" rx="4" fill="#FFFFFF" stroke="#000000" stroke-width="1.8"/>
        <text x="177" y="44" font-family="'Segoe UI', Arial, sans-serif" font-size="14.5" font-weight="bold" text-anchor="middle" fill="#000000">Public Frontline E-Services</text>

        <!-- Use cases -->
        <!-- UC1: View Announcements -->
        <ellipse cx="177" cy="90" rx="155" ry="26" fill="#FFFFFF" stroke="#000000" stroke-width="1.6"/>
        <text x="177" y="95" font-family="'Segoe UI', Arial, sans-serif" font-size="13" font-weight="bold" text-anchor="middle" fill="#000000">View Announcements &amp; Hotlines</text>

        <!-- UC_AI: Consult AI Chatbot -->
        <ellipse cx="177" cy="165" rx="155" ry="30" fill="#FFFFFF" stroke="#000000" stroke-width="1.6"/>
        <text x="177" y="162" font-family="'Segoe UI', Arial, sans-serif" font-size="13" font-weight="bold" text-anchor="middle" fill="#000000">Consult AI Chatbot for Assistance</text>
        <text x="177" y="179" font-family="'Segoe UI', Arial, sans-serif" font-size="11.5" text-anchor="middle" fill="#444444">(Google Gemini API Integration)</text>

        <!-- UC2: Apply for Clearances -->
        <ellipse cx="177" cy="245" rx="155" ry="30" fill="#FFFFFF" stroke="#000000" stroke-width="1.6"/>
        <text x="177" y="242" font-family="'Segoe UI', Arial, sans-serif" font-size="13" font-weight="bold" text-anchor="middle" fill="#000000">Apply for Clearances &amp; Appointments</text>
        <text x="177" y="259" font-family="'Segoe UI', Arial, sans-serif" font-size="11.5" text-anchor="middle" fill="#444444">(12 Official Document Offerings)</text>

        <!-- UC2_OTP: Verify OTP -->
        <ellipse cx="177" cy="325" rx="155" ry="26" fill="#FFFFFF" stroke="#000000" stroke-width="1.6"/>
        <text x="177" y="330" font-family="'Segoe UI', Arial, sans-serif" font-size="13" font-weight="bold" text-anchor="middle" fill="#000000">Verify 4-Digit OTP via Email</text>

        <!-- UC3: Track Request -->
        <ellipse cx="177" cy="405" rx="155" ry="26" fill="#FFFFFF" stroke="#000000" stroke-width="1.6"/>
        <text x="177" y="410" font-family="'Segoe UI', Arial, sans-serif" font-size="13" font-weight="bold" text-anchor="middle" fill="#000000">Track Document Request Status</text>

        <!-- UC4: Automated Emails -->
        <ellipse cx="177" cy="485" rx="155" ry="28" fill="#FFFFFF" stroke="#000000" stroke-width="1.6"/>
        <text x="177" y="482" font-family="'Segoe UI', Arial, sans-serif" font-size="13" font-weight="bold" text-anchor="middle" fill="#000000">Receive Automated Email Alerts</text>
        <text x="177" y="499" font-family="'Segoe UI', Arial, sans-serif" font-size="11.5" text-anchor="middle" fill="#444444">(Review, Approval, Pickup Notice)</text>

        <!-- Include relationships -->
        <path d="M 177 275 L 177 299" fill="none" stroke="#000000" stroke-width="1.4" stroke-dasharray="4,4" marker-end="url(#arrow3)"/>
        <text x="190" y="290" font-family="'Segoe UI', Arial, sans-serif" font-size="10.5" font-style="italic" fill="#000000">&lt;&lt;include&gt;&gt;</text>

        <path d="M 235 273 C 275 320 275 420 235 460" fill="none" stroke="#000000" stroke-width="1.4" stroke-dasharray="4,4" marker-end="url(#arrow3)"/>
        <text x="278" y="375" font-family="'Segoe UI', Arial, sans-serif" font-size="10.5" font-style="italic" fill="#000000">&lt;&lt;include&gt;&gt;</text>
    </g>

    <!-- ==================== INLINE PACKAGE 2: ADMINISTRATIVE (CENTER) ==================== -->
    <g transform="translate(600, 85)">
        <!-- Tab -->
        <path d="M 0 0 L 195 0 L 205 18 L 0 18 Z" fill="#E0E0E0" stroke="#000000" stroke-width="1.8"/>
        <text x="10" y="14" font-family="'Segoe UI', Arial, sans-serif" font-size="12" font-weight="bold" fill="#000000">Clerical &amp; Records Operations</text>
        <!-- Package body -->
        <rect x="0" y="18" width="365" height="545" rx="4" fill="#FFFFFF" stroke="#000000" stroke-width="1.8"/>
        <text x="182" y="44" font-family="'Segoe UI', Arial, sans-serif" font-size="14.5" font-weight="bold" text-anchor="middle" fill="#000000">Administrative Operations</text>

        <!-- UC5: Census Profiling -->
        <ellipse cx="182" cy="90" rx="160" ry="28" fill="#FFFFFF" stroke="#000000" stroke-width="1.6"/>
        <text x="182" y="87" font-family="'Segoe UI', Arial, sans-serif" font-size="13" font-weight="bold" text-anchor="middle" fill="#000000">Manage Resident Census Masterlist</text>
        <text x="182" y="103" font-family="'Segoe UI', Arial, sans-serif" font-size="11.5" text-anchor="middle" fill="#444444">(7 Puroks, Vulnerabilities, Demographics)</text>

        <!-- UC6: Evaluate Requests -->
        <ellipse cx="182" cy="165" rx="160" ry="28" fill="#FFFFFF" stroke="#000000" stroke-width="1.6"/>
        <text x="182" y="162" font-family="'Segoe UI', Arial, sans-serif" font-size="13" font-weight="bold" text-anchor="middle" fill="#000000">Review &amp; Evaluate Requests</text>
        <text x="182" y="178" font-family="'Segoe UI', Arial, sans-serif" font-size="11.5" text-anchor="middle" fill="#444444">(Tier 1 Clerical Verification Workflow)</text>

        <!-- UC7: Blotter Desk -->
        <ellipse cx="182" cy="245" rx="160" ry="28" fill="#FFFFFF" stroke="#000000" stroke-width="1.6"/>
        <text x="182" y="242" font-family="'Segoe UI', Arial, sans-serif" font-size="13" font-weight="bold" text-anchor="middle" fill="#000000">Manage Blotter Records &amp; Hearings</text>
        <text x="182" y="258" font-family="'Segoe UI', Arial, sans-serif" font-size="11.5" text-anchor="middle" fill="#444444">(Katarungang Pambarangay Mediation)</text>

        <!-- UC8: Relief Aid -->
        <ellipse cx="182" cy="325" rx="160" ry="28" fill="#FFFFFF" stroke="#000000" stroke-width="1.6"/>
        <text x="182" y="322" font-family="'Segoe UI', Arial, sans-serif" font-size="13" font-weight="bold" text-anchor="middle" fill="#000000">Log Calamity &amp; SAP Relief Aid</text>
        <text x="182" y="338" font-family="'Segoe UI', Arial, sans-serif" font-size="11.5" text-anchor="middle" fill="#444444">(Food Packs &amp; Financial Ayuda Logs)</text>

        <!-- UC9: OR & CTC -->
        <ellipse cx="182" cy="405" rx="160" ry="28" fill="#FFFFFF" stroke="#000000" stroke-width="1.6"/>
        <text x="182" y="402" font-family="'Segoe UI', Arial, sans-serif" font-size="13" font-weight="bold" text-anchor="middle" fill="#000000">Record Official OR &amp; CTC Payments</text>
        <text x="182" y="418" font-family="'Segoe UI', Arial, sans-serif" font-size="11.5" text-anchor="middle" fill="#444444">(Barangay Ordinance No. 2020-01)</text>

        <!-- UC10: Print Clearances -->
        <ellipse cx="182" cy="485" rx="160" ry="28" fill="#FFFFFF" stroke="#000000" stroke-width="1.6"/>
        <text x="182" y="482" font-family="'Segoe UI', Arial, sans-serif" font-size="13" font-weight="bold" text-anchor="middle" fill="#000000">Generate &amp; Print Official Clearances</text>
        <text x="182" y="498" font-family="'Segoe UI', Arial, sans-serif" font-size="11.5" text-anchor="middle" fill="#444444">(Dual-Seal Philippine Republic A4)</text>
    </g>

    <!-- ==================== INLINE PACKAGE 3: EXECUTIVE (RIGHT) ==================== -->
    <g transform="translate(985, 85)">
        <!-- Tab -->
        <path d="M 0 0 L 195 0 L 205 18 L 0 18 Z" fill="#E0E0E0" stroke="#000000" stroke-width="1.8"/>
        <text x="10" y="14" font-family="'Segoe UI', Arial, sans-serif" font-size="12" font-weight="bold" fill="#000000">Executive Governance</text>
        <!-- Package body -->
        <rect x="0" y="18" width="345" height="545" rx="4" fill="#FFFFFF" stroke="#000000" stroke-width="1.8"/>
        <text x="172" y="44" font-family="'Segoe UI', Arial, sans-serif" font-size="14.5" font-weight="bold" text-anchor="middle" fill="#000000">Executive Oversight</text>

        <!-- UC11: Analytics Dashboard -->
        <ellipse cx="172" cy="110" rx="150" ry="30" fill="#FFFFFF" stroke="#000000" stroke-width="1.6"/>
        <text x="172" y="107" font-family="'Segoe UI', Arial, sans-serif" font-size="13" font-weight="bold" text-anchor="middle" fill="#000000">View Executive Analytics</text>
        <text x="172" y="124" font-family="'Segoe UI', Arial, sans-serif" font-size="11.5" text-anchor="middle" fill="#444444">(Demographics, Revenue, Blotters)</text>

        <!-- UC12: Grant Approval -->
        <ellipse cx="172" cy="210" rx="150" ry="30" fill="#FFFFFF" stroke="#000000" stroke-width="1.6"/>
        <text x="172" y="207" font-family="'Segoe UI', Arial, sans-serif" font-size="13" font-weight="bold" text-anchor="middle" fill="#000000">Grant Executive Approval</text>
        <text x="172" y="224" font-family="'Segoe UI', Arial, sans-serif" font-size="11.5" text-anchor="middle" fill="#444444">(Tier 2 Executive Clearance Sign-off)</text>

        <!-- UC13: Oversee Lupon -->
        <ellipse cx="172" cy="320" rx="150" ry="30" fill="#FFFFFF" stroke="#000000" stroke-width="1.6"/>
        <text x="172" y="317" font-family="'Segoe UI', Arial, sans-serif" font-size="13" font-weight="bold" text-anchor="middle" fill="#000000">Oversee Lupon Resolutions</text>
        <text x="172" y="334" font-family="'Segoe UI', Arial, sans-serif" font-size="11.5" text-anchor="middle" fill="#444444">(Amicable Settlements &amp; CFA Issuance)</text>

        <!-- UC14: Sign Official Documents -->
        <ellipse cx="172" cy="440" rx="150" ry="30" fill="#FFFFFF" stroke="#000000" stroke-width="1.6"/>
        <text x="172" y="437" font-family="'Segoe UI', Arial, sans-serif" font-size="13" font-weight="bold" text-anchor="middle" fill="#000000">Sign &amp; Issue Official Clearances</text>
        <text x="172" y="454" font-family="'Segoe UI', Arial, sans-serif" font-size="11.5" text-anchor="middle" fill="#444444">(Executive Signature Authorization)</text>
    </g>

    <!-- ==================== RIGHT ACTORS: SECRETARY & CAPTAIN ==================== -->
    <!-- Secretary Actor -->
    <g transform="translate(1455, 230)">
        <circle cx="0" cy="-45" r="14" fill="#FFFFFF" stroke="#000000" stroke-width="2.2"/>
        <line x1="0" y1="-31" x2="0" y2="10" stroke="#000000" stroke-width="2.2"/>
        <line x1="-24" y1="-18" x2="24" y2="-18" stroke="#000000" stroke-width="2.2"/>
        <line x1="0" y1="10" x2="-18" y2="40" stroke="#000000" stroke-width="2.2"/>
        <line x1="0" y1="10" x2="18" y2="40" stroke="#000000" stroke-width="2.2"/>
        <text x="0" y="62" font-family="'Segoe UI', Arial, sans-serif" font-size="14.5" font-weight="bold" text-anchor="middle" fill="#000000">Mrs. Pearl Joy J. Amuan</text>
        <text x="0" y="80" font-family="'Segoe UI', Arial, sans-serif" font-size="13" text-anchor="middle" fill="#333333">(Barangay Secretary)</text>
    </g>

    <!-- Captain Actor -->
    <g transform="translate(1455, 485)">
        <circle cx="0" cy="-45" r="14" fill="#FFFFFF" stroke="#000000" stroke-width="2.2"/>
        <line x1="0" y1="-31" x2="0" y2="10" stroke="#000000" stroke-width="2.2"/>
        <line x1="-24" y1="-18" x2="24" y2="-18" stroke="#000000" stroke-width="2.2"/>
        <line x1="0" y1="10" x2="-18" y2="40" stroke="#000000" stroke-width="2.2"/>
        <line x1="0" y1="10" x2="18" y2="40" stroke="#000000" stroke-width="2.2"/>
        <text x="0" y="62" font-family="'Segoe UI', Arial, sans-serif" font-size="14.5" font-weight="bold" text-anchor="middle" fill="#000000">Hon. Stephen James D. Foerster</text>
        <text x="0" y="80" font-family="'Segoe UI', Arial, sans-serif" font-size="13" text-anchor="middle" fill="#333333">(Punong Barangay)</text>
    </g>

    <!-- ==================== CONNECTING LINES ==================== -->
    <!-- Resident -> Package 1 Use Cases -->
    <line x1="110" y1="280" x2="247" y2="175" stroke="#000000" stroke-width="1.6"/>
    <line x1="110" y1="290" x2="247" y2="250" stroke="#000000" stroke-width="1.6"/>
    <line x1="110" y1="300" x2="247" y2="330" stroke="#000000" stroke-width="1.6"/>
    <line x1="110" y1="310" x2="247" y2="490" stroke="#000000" stroke-width="1.6"/>

    <!-- Secretary -> Package 2 Use Cases -->
    <line x1="1380" y1="210" x2="965" y2="175" stroke="#000000" stroke-width="1.6"/>
    <line x1="1380" y1="225" x2="965" y2="250" stroke="#000000" stroke-width="1.6"/>
    <line x1="1380" y1="240" x2="965" y2="330" stroke="#000000" stroke-width="1.6"/>
    <line x1="1380" y1="255" x2="965" y2="410" stroke="#000000" stroke-width="1.6"/>
    <line x1="1380" y1="270" x2="965" y2="490" stroke="#000000" stroke-width="1.6"/>
    <line x1="1380" y1="280" x2="965" y2="570" stroke="#000000" stroke-width="1.6"/>

    <!-- Captain -> Package 3 Use Cases -->
    <line x1="1380" y1="465" x2="1320" y2="195" stroke="#000000" stroke-width="1.6"/>
    <line x1="1380" y1="480" x2="1320" y2="295" stroke="#000000" stroke-width="1.6"/>
    <line x1="1380" y1="495" x2="1320" y2="405" stroke="#000000" stroke-width="1.6"/>
    <line x1="1380" y1="510" x2="1320" y2="525" stroke="#000000" stroke-width="1.6"/>
</svg>"""

    with open(svg_path, 'w', encoding='utf-8') as f:
        f.write(svg_content)
    print(f"Generated Figure 3 SVG: {svg_path}")

    cmd = [
        chrome_path,
        '--headless',
        '--disable-gpu',
        f'--screenshot={png_path}',
        '--window-size=1560,690',
        '--force-device-scale-factor=2',
        svg_path
    ]
    subprocess.run(cmd, check=True)
    print(f"Rendered Figure 3 PNG: {png_path} ({os.path.getsize(png_path)} bytes)")

if __name__ == "__main__":
    generate_figure3_svg()

