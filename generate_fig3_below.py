import os
import subprocess
import shutil
from PIL import Image

output_dir = os.path.abspath('Documentation/Diagrams')
chrome_path = r'C:\Program Files\Google\Chrome\Application\chrome.exe'

def generate_figure3_below_layout():
    svg_path = os.path.join(output_dir, "figure3_use_case_diagram.svg")
    png_path = os.path.join(output_dir, "figure3_use_case_diagram.png")
    
    # Also save with explicit alternate name for easy reference
    svg_alt = os.path.join(output_dir, "figure3_use_case_diagram_executive_below.svg")
    png_alt = os.path.join(output_dir, "figure3_use_case_diagram_executive_below.png")

    svg_content = """<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1560 970" width="1560" height="970">
    svg_content = """<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1560 1060" width="1560" height="1060">
    <defs>
        <marker id="arrow3b" viewBox="0 0 10 10" refX="8" refY="5" markerWidth="6" markerHeight="6" orient="auto-start-reverse">
            <path d="M 0 1.5 L 8 5 L 0 8.5 z" fill="#000000"/>
        </marker>
        <filter id="shadow3b" x="-2%" y="-2%" width="104%" height="104%">
            <feDropShadow dx="2" dy="2" stdDeviation="2" flood-color="#000000" flood-opacity="0.08"/>
        </filter>
    </defs>

    <!-- Canvas Background -->
    <rect width="1560" height="970" fill="#FFFFFF"/>
    <rect width="1560" height="1060" fill="#FFFFFF"/>

    <!-- ==================== LEFT ACTOR: RESIDENT ==================== -->
    <g transform="translate(95, 335)">
        <!-- Stick figure actor -->
    <g transform="translate(95, 325)">
        <circle cx="0" cy="-45" r="15" fill="#FFFFFF" stroke="#000000" stroke-width="2.2"/>
        <line x1="0" y1="-30" x2="0" y2="12" stroke="#000000" stroke-width="2.2"/>
        <line x1="-26" y1="-16" x2="26" y2="-16" stroke="#000000" stroke-width="2.2"/>
        <line x1="0" y1="12" x2="-20" y2="44" stroke="#000000" stroke-width="2.2"/>
        <line x1="0" y1="12" x2="20" y2="44" stroke="#000000" stroke-width="2.2"/>
        <!-- Text label -->
        <text x="0" y="68" font-family="'Segoe UI', Arial, sans-serif" font-size="15" font-weight="bold" text-anchor="middle" fill="#000000">Resident / Citizen</text>
        <text x="0" y="88" font-family="'Segoe UI', Arial, sans-serif" font-size="13.5" text-anchor="middle" fill="#333333">(General Public)</text>
    </g>

    <!-- ==================== SYSTEM BOUNDARY CONTAINER ==================== -->
    <rect x="205" y="25" width="1135" height="920" rx="6" fill="#FAFAFA" stroke="#000000" stroke-width="2.2" filter="url(#shadow3b)"/>
    <!-- System Title Banner -->
    <!-- ==================== SYSTEM BOUNDARY ==================== -->
    <rect x="205" y="25" width="1135" height="1005" rx="8" fill="#FDFDFD" stroke="#000000" stroke-width="2.2" filter="url(#shadow3b)"/>
    <rect x="205" y="25" width="1135" height="42" rx="6" fill="#EBEBEB" stroke="#000000" stroke-width="2.2"/>
    <text x="772" y="53" font-family="'Segoe UI', Arial, sans-serif" font-size="17.5" font-weight="bold" text-anchor="middle" fill="#000000">Barangay Information and Management System (BIMS)</text>

    <!-- ==================== TOP-LEFT: PACKAGE 1 (CITIZEN SERVICES) ==================== -->
    <g transform="translate(225, 85)">
        <!-- Tab -->
        <path d="M 0 0 L 185 0 L 195 20 L 0 20 Z" fill="#E0E0E0" stroke="#000000" stroke-width="1.8"/>
        <text x="12" y="15" font-family="'Segoe UI', Arial, sans-serif" font-size="12" font-weight="bold" fill="#000000">Citizen Frontline Services</text>
        <!-- Package body -->
        <rect x="0" y="20" width="525" height="520" rx="4" fill="#FFFFFF" stroke="#000000" stroke-width="1.8"/>
        <rect x="0" y="20" width="525" height="495" rx="4" fill="#FFFFFF" stroke="#000000" stroke-width="1.8"/>
        <text x="262" y="48" font-family="'Segoe UI', Arial, sans-serif" font-size="15" font-weight="bold" text-anchor="middle" fill="#000000">Public Frontline E-Services</text>

        <!-- UC1: View Announcements -->
        <ellipse cx="262" cy="92" rx="200" ry="26" fill="#FFFFFF" stroke="#000000" stroke-width="1.6"/>
        <text x="262" y="97" font-family="'Segoe UI', Arial, sans-serif" font-size="13.5" font-weight="bold" text-anchor="middle" fill="#000000">View Announcements &amp; Hotlines</text>
        <ellipse cx="262" cy="88" rx="200" ry="25" fill="#FFFFFF" stroke="#000000" stroke-width="1.6"/>
        <text x="262" y="93" font-family="'Segoe UI', Arial, sans-serif" font-size="13.5" font-weight="bold" text-anchor="middle" fill="#000000">View Announcements &amp; Hotlines</text>

        <!-- UC_AI: Consult AI Chatbot -->
        <ellipse cx="262" cy="165" rx="200" ry="30" fill="#FFFFFF" stroke="#000000" stroke-width="1.6"/>
        <text x="262" y="162" font-family="'Segoe UI', Arial, sans-serif" font-size="13.5" font-weight="bold" text-anchor="middle" fill="#000000">Consult AI Chatbot for Assistance</text>
        <text x="262" y="179" font-family="'Segoe UI', Arial, sans-serif" font-size="12" text-anchor="middle" fill="#444444">(Google Gemini API Integration)</text>
        <ellipse cx="262" cy="156" rx="200" ry="28" fill="#FFFFFF" stroke="#000000" stroke-width="1.6"/>
        <text x="262" y="153" font-family="'Segoe UI', Arial, sans-serif" font-size="13.5" font-weight="bold" text-anchor="middle" fill="#000000">Consult AI Chatbot for Assistance</text>
        <text x="262" y="170" font-family="'Segoe UI', Arial, sans-serif" font-size="11.5" text-anchor="middle" fill="#444444">(Google Gemini API Integration)</text>

        <!-- UC2: Apply for Clearances -->
        <ellipse cx="262" cy="242" rx="200" ry="30" fill="#FFFFFF" stroke="#000000" stroke-width="1.6"/>
        <text x="262" y="239" font-family="'Segoe UI', Arial, sans-serif" font-size="13.5" font-weight="bold" text-anchor="middle" fill="#000000">Apply for Clearances &amp; Appointments</text>
        <text x="262" y="256" font-family="'Segoe UI', Arial, sans-serif" font-size="12" text-anchor="middle" fill="#444444">(12 Official Document Offerings)</text>
        <ellipse cx="262" cy="228" rx="200" ry="28" fill="#FFFFFF" stroke="#000000" stroke-width="1.6"/>
        <text x="262" y="225" font-family="'Segoe UI', Arial, sans-serif" font-size="13.5" font-weight="bold" text-anchor="middle" fill="#000000">Apply for Clearances &amp; Appointments</text>
        <text x="262" y="242" font-family="'Segoe UI', Arial, sans-serif" font-size="11.5" text-anchor="middle" fill="#444444">(12 Official Document Offerings)</text>

        <!-- UC2_OTP: Verify OTP -->
        <ellipse cx="262" cy="320" rx="200" ry="26" fill="#FFFFFF" stroke="#000000" stroke-width="1.6"/>
        <text x="262" y="325" font-family="'Segoe UI', Arial, sans-serif" font-size="13.5" font-weight="bold" text-anchor="middle" fill="#000000">Verify 4-Digit OTP via Email</text>
        <ellipse cx="262" cy="300" rx="200" ry="25" fill="#FFFFFF" stroke="#000000" stroke-width="1.6"/>
        <text x="262" y="305" font-family="'Segoe UI', Arial, sans-serif" font-size="13.5" font-weight="bold" text-anchor="middle" fill="#000000">Verify 4-Digit OTP via Email</text>

        <!-- UC3: Track Request -->
        <ellipse cx="262" cy="395" rx="200" ry="26" fill="#FFFFFF" stroke="#000000" stroke-width="1.6"/>
        <text x="262" y="400" font-family="'Segoe UI', Arial, sans-serif" font-size="13.5" font-weight="bold" text-anchor="middle" fill="#000000">Track Document Request Status</text>
        <ellipse cx="262" cy="372" rx="200" ry="25" fill="#FFFFFF" stroke="#000000" stroke-width="1.6"/>
        <text x="262" y="377" font-family="'Segoe UI', Arial, sans-serif" font-size="13.5" font-weight="bold" text-anchor="middle" fill="#000000">Track Document Request Status</text>

        <!-- UC4: Automated Emails -->
        <ellipse cx="262" cy="470" rx="200" ry="28" fill="#FFFFFF" stroke="#000000" stroke-width="1.6"/>
        <text x="262" y="467" font-family="'Segoe UI', Arial, sans-serif" font-size="13.5" font-weight="bold" text-anchor="middle" fill="#000000">Receive Automated Email Alerts</text>
        <text x="262" y="484" font-family="'Segoe UI', Arial, sans-serif" font-size="12" text-anchor="middle" fill="#444444">(Review, Approval, Pickup Notice)</text>
        <ellipse cx="262" cy="445" rx="200" ry="27" fill="#FFFFFF" stroke="#000000" stroke-width="1.6"/>
        <text x="262" y="442" font-family="'Segoe UI', Arial, sans-serif" font-size="13.5" font-weight="bold" text-anchor="middle" fill="#000000">Receive Automated Email Alerts</text>
        <text x="262" y="458" font-family="'Segoe UI', Arial, sans-serif" font-size="11.5" text-anchor="middle" fill="#444444">(Review, Approval, Pickup Notice)</text>

        <!-- Include relationships -->
        <path d="M 262 272 L 262 294" fill="none" stroke="#000000" stroke-width="1.4" stroke-dasharray="4,4" marker-end="url(#arrow3b)"/>
        <text x="275" y="287" font-family="'Segoe UI', Arial, sans-serif" font-size="11" font-style="italic" fill="#000000">&lt;&lt;include&gt;&gt;</text>
        <path d="M 262 256 L 262 275" fill="none" stroke="#000000" stroke-width="1.4" stroke-dasharray="4,4" marker-end="url(#arrow3b)"/>
        <text x="275" y="269" font-family="'Segoe UI', Arial, sans-serif" font-size="11" font-style="italic" fill="#000000">&lt;&lt;include&gt;&gt;</text>

        <path d="M 335 270 C 375 315 375 405 335 444" fill="none" stroke="#000000" stroke-width="1.4" stroke-dasharray="4,4" marker-end="url(#arrow3b)"/>
        <text x="380" y="360" font-family="'Segoe UI', Arial, sans-serif" font-size="11" font-style="italic" fill="#000000">&lt;&lt;include&gt;&gt;</text>
        <path d="M 335 254 C 375 295 375 385 335 422" fill="none" stroke="#000000" stroke-width="1.4" stroke-dasharray="4,4" marker-end="url(#arrow3b)"/>
        <text x="380" y="340" font-family="'Segoe UI', Arial, sans-serif" font-size="11" font-style="italic" fill="#000000">&lt;&lt;include&gt;&gt;</text>
    </g>

    <!-- ==================== TOP-RIGHT: PACKAGE 2 (ADMINISTRATIVE) ==================== -->
    <g transform="translate(775, 85)">
        <!-- Tab -->
        <path d="M 0 0 L 205 0 L 215 20 L 0 20 Z" fill="#E0E0E0" stroke="#000000" stroke-width="1.8"/>
        <text x="12" y="15" font-family="'Segoe UI', Arial, sans-serif" font-size="12" font-weight="bold" fill="#000000">Clerical &amp; Records Operations</text>
        <!-- Package body -->
        <rect x="0" y="20" width="545" height="520" rx="4" fill="#FFFFFF" stroke="#000000" stroke-width="1.8"/>
        <rect x="0" y="20" width="545" height="495" rx="4" fill="#FFFFFF" stroke="#000000" stroke-width="1.8"/>
        <text x="272" y="48" font-family="'Segoe UI', Arial, sans-serif" font-size="15" font-weight="bold" text-anchor="middle" fill="#000000">Administrative Operations</text>

        <!-- UC5: Census Profiling -->
        <ellipse cx="272" cy="92" rx="215" ry="28" fill="#FFFFFF" stroke="#000000" stroke-width="1.6"/>
        <text x="272" y="89" font-family="'Segoe UI', Arial, sans-serif" font-size="13.5" font-weight="bold" text-anchor="middle" fill="#000000">Manage Resident Census Masterlist</text>
        <text x="272" y="105" font-family="'Segoe UI', Arial, sans-serif" font-size="12" text-anchor="middle" fill="#444444">(7 Puroks, Vulnerabilities, Demographics)</text>
        <ellipse cx="272" cy="88" rx="215" ry="26" fill="#FFFFFF" stroke="#000000" stroke-width="1.6"/>
        <text x="272" y="85" font-family="'Segoe UI', Arial, sans-serif" font-size="13.5" font-weight="bold" text-anchor="middle" fill="#000000">Manage Resident Census Masterlist</text>
        <text x="272" y="101" font-family="'Segoe UI', Arial, sans-serif" font-size="11.5" text-anchor="middle" fill="#444444">(7 Puroks, Vulnerabilities, Demographics)</text>

        <!-- UC6: Evaluate Requests -->
        <ellipse cx="272" cy="165" rx="215" ry="28" fill="#FFFFFF" stroke="#000000" stroke-width="1.6"/>
        <text x="272" y="162" font-family="'Segoe UI', Arial, sans-serif" font-size="13.5" font-weight="bold" text-anchor="middle" fill="#000000">Review &amp; Evaluate Requests</text>
        <text x="272" y="178" font-family="'Segoe UI', Arial, sans-serif" font-size="12" text-anchor="middle" fill="#444444">(Tier 1 Clerical Verification Workflow)</text>
        <ellipse cx="272" cy="156" rx="215" ry="26" fill="#FFFFFF" stroke="#000000" stroke-width="1.6"/>
        <text x="272" y="153" font-family="'Segoe UI', Arial, sans-serif" font-size="13.5" font-weight="bold" text-anchor="middle" fill="#000000">Review &amp; Evaluate Requests</text>
        <text x="272" y="169" font-family="'Segoe UI', Arial, sans-serif" font-size="11.5" text-anchor="middle" fill="#444444">(Tier 1 Clerical Verification Workflow)</text>

        <!-- UC7: Blotter Desk -->
        <ellipse cx="272" cy="242" rx="215" ry="28" fill="#FFFFFF" stroke="#000000" stroke-width="1.6"/>
        <text x="272" y="239" font-family="'Segoe UI', Arial, sans-serif" font-size="13.5" font-weight="bold" text-anchor="middle" fill="#000000">Manage Blotter Records &amp; Hearings</text>
        <text x="272" y="255" font-family="'Segoe UI', Arial, sans-serif" font-size="12" text-anchor="middle" fill="#444444">(Katarungang Pambarangay Mediation)</text>
        <ellipse cx="272" cy="228" rx="215" ry="26" fill="#FFFFFF" stroke="#000000" stroke-width="1.6"/>
        <text x="272" y="225" font-family="'Segoe UI', Arial, sans-serif" font-size="13.5" font-weight="bold" text-anchor="middle" fill="#000000">Manage Blotter Records &amp; Hearings</text>
        <text x="272" y="241" font-family="'Segoe UI', Arial, sans-serif" font-size="11.5" text-anchor="middle" fill="#444444">(Katarungang Pambarangay Mediation)</text>

        <!-- UC8: Relief Aid -->
        <ellipse cx="272" cy="320" rx="215" ry="28" fill="#FFFFFF" stroke="#000000" stroke-width="1.6"/>
        <text x="272" y="317" font-family="'Segoe UI', Arial, sans-serif" font-size="13.5" font-weight="bold" text-anchor="middle" fill="#000000">Log Calamity &amp; SAP Relief Aid</text>
        <text x="272" y="333" font-family="'Segoe UI', Arial, sans-serif" font-size="12" text-anchor="middle" fill="#444444">(Food Packs &amp; Financial Ayuda Logs)</text>
        <ellipse cx="272" cy="300" rx="215" ry="26" fill="#FFFFFF" stroke="#000000" stroke-width="1.6"/>
        <text x="272" y="297" font-family="'Segoe UI', Arial, sans-serif" font-size="13.5" font-weight="bold" text-anchor="middle" fill="#000000">Log Calamity &amp; SAP Relief Aid</text>
        <text x="272" y="313" font-family="'Segoe UI', Arial, sans-serif" font-size="11.5" text-anchor="middle" fill="#444444">(Food Packs &amp; Financial Ayuda Logs)</text>

        <!-- UC9: OR & CTC -->
        <ellipse cx="272" cy="395" rx="215" ry="28" fill="#FFFFFF" stroke="#000000" stroke-width="1.6"/>
        <text x="272" y="392" font-family="'Segoe UI', Arial, sans-serif" font-size="13.5" font-weight="bold" text-anchor="middle" fill="#000000">Record Official OR &amp; CTC Payments</text>
        <text x="272" y="408" font-family="'Segoe UI', Arial, sans-serif" font-size="12" text-anchor="middle" fill="#444444">(Barangay Ordinance No. 2020-01)</text>
        <ellipse cx="272" cy="372" rx="215" ry="26" fill="#FFFFFF" stroke="#000000" stroke-width="1.6"/>
        <text x="272" y="369" font-family="'Segoe UI', Arial, sans-serif" font-size="13.5" font-weight="bold" text-anchor="middle" fill="#000000">Record Official OR &amp; CTC Payments</text>
        <text x="272" y="385" font-family="'Segoe UI', Arial, sans-serif" font-size="11.5" text-anchor="middle" fill="#444444">(Barangay Ordinance No. 2020-01)</text>

        <!-- UC10: Print Clearances -->
        <ellipse cx="272" cy="470" rx="215" ry="28" fill="#FFFFFF" stroke="#000000" stroke-width="1.6"/>
        <text x="272" y="467" font-family="'Segoe UI', Arial, sans-serif" font-size="13.5" font-weight="bold" text-anchor="middle" fill="#000000">Generate &amp; Print Official Clearances</text>
        <text x="272" y="483" font-family="'Segoe UI', Arial, sans-serif" font-size="12" text-anchor="middle" fill="#444444">(Dual-Seal Philippine Republic A4)</text>
        <ellipse cx="272" cy="445" rx="215" ry="26" fill="#FFFFFF" stroke="#000000" stroke-width="1.6"/>
        <text x="272" y="442" font-family="'Segoe UI', Arial, sans-serif" font-size="13.5" font-weight="bold" text-anchor="middle" fill="#000000">Generate &amp; Print Official Clearances</text>
        <text x="272" y="458" font-family="'Segoe UI', Arial, sans-serif" font-size="11.5" text-anchor="middle" fill="#444444">(Dual-Seal Philippine Republic A4)</text>
    </g>

    <!-- ==================== BOTTOM: PACKAGE 3 (EXECUTIVE GOVERNANCE - PLACED BELOW THE 2) ==================== -->
    <g transform="translate(225, 635)">
        <!-- Tab -->
    <!-- ==================== BOTTOM: PACKAGE 3 (EXECUTIVE GOVERNANCE - STACKED UP AND DOWN, NOT INLINE) ==================== -->
    <g transform="translate(492, 615)">
        <path d="M 0 0 L 220 0 L 232 20 L 0 20 Z" fill="#E0E0E0" stroke="#000000" stroke-width="1.8"/>
        <text x="12" y="15" font-family="'Segoe UI', Arial, sans-serif" font-size="12" font-weight="bold" fill="#000000">Executive Governance &amp; Oversight</text>
        <!-- Package body spanning across -->
        <rect x="0" y="20" width="1095" height="265" rx="4" fill="#FFFFFF" stroke="#000000" stroke-width="1.8"/>
        <text x="547" y="48" font-family="'Segoe UI', Arial, sans-serif" font-size="15" font-weight="bold" text-anchor="middle" fill="#000000">Executive Oversight &amp; Authorization</text>
        <rect x="0" y="20" width="560" height="375" rx="4" fill="#FFFFFF" stroke="#000000" stroke-width="1.8"/>
        <text x="280" y="48" font-family="'Segoe UI', Arial, sans-serif" font-size="15" font-weight="bold" text-anchor="middle" fill="#000000">Executive Oversight &amp; Authorization</text>

        <!-- 4 Use cases arranged horizontally inside Package 3 -->
        <!-- 4 Executive components stacked up and down vertically -->
        <!-- UC11: Analytics Dashboard -->
        <ellipse cx="145" cy="150" rx="125" ry="46" fill="#FFFFFF" stroke="#000000" stroke-width="1.6"/>
        <text x="145" y="142" font-family="'Segoe UI', Arial, sans-serif" font-size="13" font-weight="bold" text-anchor="middle" fill="#000000">View Executive</text>
        <text x="145" y="158" font-family="'Segoe UI', Arial, sans-serif" font-size="13" font-weight="bold" text-anchor="middle" fill="#000000">Analytics Dashboard</text>
        <text x="145" y="174" font-family="'Segoe UI', Arial, sans-serif" font-size="11.5" text-anchor="middle" fill="#444444">(Demographics &amp; Revenue)</text>
        <ellipse cx="280" cy="92" rx="225" ry="26" fill="#FFFFFF" stroke="#000000" stroke-width="1.6"/>
        <text x="280" y="89" font-family="'Segoe UI', Arial, sans-serif" font-size="13.5" font-weight="bold" text-anchor="middle" fill="#000000">View Executive Analytics Dashboard</text>
        <text x="280" y="105" font-family="'Segoe UI', Arial, sans-serif" font-size="11.5" text-anchor="middle" fill="#444444">(Demographics, Revenue &amp; Performance)</text>

        <!-- UC12: Grant Approval -->
        <ellipse cx="410" cy="150" rx="125" ry="46" fill="#FFFFFF" stroke="#000000" stroke-width="1.6"/>
        <text x="410" y="142" font-family="'Segoe UI', Arial, sans-serif" font-size="13" font-weight="bold" text-anchor="middle" fill="#000000">Grant Executive</text>
        <text x="410" y="158" font-family="'Segoe UI', Arial, sans-serif" font-size="13" font-weight="bold" text-anchor="middle" fill="#000000">Approval</text>
        <text x="410" y="174" font-family="'Segoe UI', Arial, sans-serif" font-size="11.5" text-anchor="middle" fill="#444444">(Tier 2 Final Sign-off)</text>
        <ellipse cx="280" cy="165" rx="225" ry="26" fill="#FFFFFF" stroke="#000000" stroke-width="1.6"/>
        <text x="280" y="162" font-family="'Segoe UI', Arial, sans-serif" font-size="13.5" font-weight="bold" text-anchor="middle" fill="#000000">Grant Executive Approval</text>
        <text x="280" y="178" font-family="'Segoe UI', Arial, sans-serif" font-size="11.5" text-anchor="middle" fill="#444444">(Tier 2 Final Sign-off for Clearances)</text>

        <!-- UC13: Oversee Lupon -->
        <ellipse cx="680" cy="150" rx="130" ry="46" fill="#FFFFFF" stroke="#000000" stroke-width="1.6"/>
        <text x="680" y="142" font-family="'Segoe UI', Arial, sans-serif" font-size="13" font-weight="bold" text-anchor="middle" fill="#000000">Oversee Lupon Dispute</text>
        <text x="680" y="158" font-family="'Segoe UI', Arial, sans-serif" font-size="13" font-weight="bold" text-anchor="middle" fill="#000000">Resolutions</text>
        <text x="680" y="174" font-family="'Segoe UI', Arial, sans-serif" font-size="11.5" text-anchor="middle" fill="#444444">(Mediation &amp; CFA Issuance)</text>
        <ellipse cx="280" cy="238" rx="225" ry="26" fill="#FFFFFF" stroke="#000000" stroke-width="1.6"/>
        <text x="280" y="235" font-family="'Segoe UI', Arial, sans-serif" font-size="13.5" font-weight="bold" text-anchor="middle" fill="#000000">Oversee Lupon Dispute Resolutions</text>
        <text x="280" y="251" font-family="'Segoe UI', Arial, sans-serif" font-size="11.5" text-anchor="middle" fill="#444444">(Mediation, Settlement &amp; CFA Issuance)</text>

        <!-- UC14: Sign Official Documents -->
        <ellipse cx="950" cy="150" rx="125" ry="46" fill="#FFFFFF" stroke="#000000" stroke-width="1.6"/>
        <text x="950" y="142" font-family="'Segoe UI', Arial, sans-serif" font-size="13" font-weight="bold" text-anchor="middle" fill="#000000">Sign &amp; Issue</text>
        <text x="950" y="158" font-family="'Segoe UI', Arial, sans-serif" font-size="13" font-weight="bold" text-anchor="middle" fill="#000000">Official Clearances</text>
        <text x="950" y="174" font-family="'Segoe UI', Arial, sans-serif" font-size="11.5" text-anchor="middle" fill="#444444">(Executive Authorization)</text>
        <ellipse cx="280" cy="312" rx="225" ry="26" fill="#FFFFFF" stroke="#000000" stroke-width="1.6"/>
        <text x="280" y="309" font-family="'Segoe UI', Arial, sans-serif" font-size="13.5" font-weight="bold" text-anchor="middle" fill="#000000">Sign &amp; Issue Official Clearances</text>
        <text x="280" y="325" font-family="'Segoe UI', Arial, sans-serif" font-size="11.5" text-anchor="middle" fill="#444444">(Executive Dual-Seal Authorization)</text>
    </g>

    <!-- ==================== RIGHT ACTORS ==================== -->
    <!-- Secretary Actor (Top Right) -->
    <g transform="translate(1455, 335)">
    <g transform="translate(1455, 325)">
        <circle cx="0" cy="-45" r="15" fill="#FFFFFF" stroke="#000000" stroke-width="2.2"/>
        <line x1="0" y1="-30" x2="0" y2="12" stroke="#000000" stroke-width="2.2"/>
        <line x1="-26" y1="-16" x2="26" y2="-16" stroke="#000000" stroke-width="2.2"/>
        <line x1="0" y1="12" x2="-20" y2="44" stroke="#000000" stroke-width="2.2"/>
        <line x1="0" y1="12" x2="20" y2="44" stroke="#000000" stroke-width="2.2"/>
        <text x="0" y="68" font-family="'Segoe UI', Arial, sans-serif" font-size="15" font-weight="bold" text-anchor="middle" fill="#000000">Mrs. Pearl Joy J. Amuan</text>
        <text x="0" y="88" font-family="'Segoe UI', Arial, sans-serif" font-size="13.5" text-anchor="middle" fill="#333333">(Barangay Secretary)</text>
    </g>

    <!-- Captain Actor (Bottom Right) -->
    <g transform="translate(1455, 775)">
    <g transform="translate(1455, 805)">
        <circle cx="0" cy="-45" r="15" fill="#FFFFFF" stroke="#000000" stroke-width="2.2"/>
        <line x1="0" y1="-30" x2="0" y2="12" stroke="#000000" stroke-width="2.2"/>
        <line x1="-26" y1="-16" x2="26" y2="-16" stroke="#000000" stroke-width="2.2"/>
        <line x1="0" y1="12" x2="-20" y2="44" stroke="#000000" stroke-width="2.2"/>
        <line x1="0" y1="12" x2="20" y2="44" stroke="#000000" stroke-width="2.2"/>
        <text x="0" y="68" font-family="'Segoe UI', Arial, sans-serif" font-size="15" font-weight="bold" text-anchor="middle" fill="#000000">Hon. Stephen James D. Foerster</text>
        <text x="0" y="88" font-family="'Segoe UI', Arial, sans-serif" font-size="13.5" text-anchor="middle" fill="#333333">(Punong Barangay)</text>
    </g>

    <!-- ==================== CONNECTING LINES ==================== -->
    <!-- Resident -> Package 1 Use Cases -->
    <line x1="120" y1="320" x2="280" y2="185" stroke="#000000" stroke-width="1.6"/>
    <line x1="120" y1="330" x2="280" y2="255" stroke="#000000" stroke-width="1.6"/>
    <line x1="120" y1="340" x2="280" y2="330" stroke="#000000" stroke-width="1.6"/>
    <line x1="120" y1="350" x2="280" y2="480" stroke="#000000" stroke-width="1.6"/>
    <line x1="120" y1="360" x2="280" y2="555" stroke="#000000" stroke-width="1.6"/>
    <line x1="120" y1="310" x2="287" y2="173" stroke="#000000" stroke-width="1.6"/>
    <line x1="120" y1="320" x2="287" y2="241" stroke="#000000" stroke-width="1.6"/>
    <line x1="120" y1="330" x2="287" y2="313" stroke="#000000" stroke-width="1.6"/>
    <line x1="120" y1="340" x2="287" y2="457" stroke="#000000" stroke-width="1.6"/>

    <!-- Secretary -> Package 2 Use Cases -->
    <line x1="1380" y1="315" x2="1245" y2="185" stroke="#000000" stroke-width="1.6"/>
    <line x1="1380" y1="325" x2="1245" y2="255" stroke="#000000" stroke-width="1.6"/>
    <line x1="1380" y1="335" x2="1245" y2="330" stroke="#000000" stroke-width="1.6"/>
    <line x1="1380" y1="345" x2="1245" y2="408" stroke="#000000" stroke-width="1.6"/>
    <line x1="1380" y1="355" x2="1245" y2="480" stroke="#000000" stroke-width="1.6"/>
    <line x1="1380" y1="365" x2="1245" y2="555" stroke="#000000" stroke-width="1.6"/>
    <line x1="1380" y1="305" x2="1262" y2="173" stroke="#000000" stroke-width="1.6"/>
    <line x1="1380" y1="315" x2="1262" y2="241" stroke="#000000" stroke-width="1.6"/>
    <line x1="1380" y1="325" x2="1262" y2="313" stroke="#000000" stroke-width="1.6"/>
    <line x1="1380" y1="335" x2="1262" y2="385" stroke="#000000" stroke-width="1.6"/>
    <line x1="1380" y1="345" x2="1262" y2="457" stroke="#000000" stroke-width="1.6"/>
    <line x1="1380" y1="355" x2="1262" y2="530" stroke="#000000" stroke-width="1.6"/>

    <!-- Captain -> Package 3 Use Cases -->
    <line x1="1375" y1="765" x2="1295" y2="785" stroke="#000000" stroke-width="1.6"/>
    <line x1="1375" y1="775" x2="1035" y2="785" stroke="#000000" stroke-width="1.6"/>
    <line x1="1375" y1="785" x2="765" y2="785" stroke="#000000" stroke-width="1.6"/>
    <line x1="1375" y1="795" x2="500" y2="785" stroke="#000000" stroke-width="1.6"/>
    <!-- Captain -> Package 3 Use Cases (Clean direct diagonal lines, 0 crossings) -->
    <line x1="1375" y1="785" x2="997" y2="707" stroke="#000000" stroke-width="1.6"/>
    <line x1="1375" y1="795" x2="997" y2="780" stroke="#000000" stroke-width="1.6"/>
    <line x1="1375" y1="805" x2="997" y2="853" stroke="#000000" stroke-width="1.6"/>
    <line x1="1375" y1="815" x2="997" y2="927" stroke="#000000" stroke-width="1.6"/>
</svg>"""

    with open(svg_path, 'w', encoding='utf-8') as f:
        f.write(svg_content)
    with open(svg_alt, 'w', encoding='utf-8') as f:
        f.write(svg_content)
    print(f"Generated SVG: {svg_path} & {svg_alt}")

    cmd = [
        chrome_path,
        '--headless',
        '--disable-gpu',
        f'--screenshot={png_path}',
        '--window-size=1560,970',
        '--window-size=1560,1060',
        '--force-device-scale-factor=2',
        svg_path
    ]
    subprocess.run(cmd, check=True)
    
    # Also save copy with explicit alt name
    shutil.copyfile(png_path, png_alt)
    print(f"Rendered High-Res PNG: {png_path} & {png_alt} ({os.path.getsize(png_path)} bytes)")

if __name__ == "__main__":
    generate_figure3_below_layout()
