import os
import re

md_path = "Documentation/Barangay_Information_Management_System_Manuscript_Ch1-3.md"

with open(md_path, "r", encoding="utf-8") as f:
    content = f.read()

# 1. Names
content = content.replace("Hon. Roberto S. Alen", "Hon. Stephen James D. Foerster")
content = content.replace("Roberto S. Alen", "Hon. Stephen James D. Foerster")
content = content.replace("Hon. Roberto Dacutan", "Hon. Stephen James D. Foerster")
content = content.replace("Roberto Dacutan", "Hon. Stephen James D. Foerster")
content = content.replace("Mrs. Ma. Elena Balleza", "Mrs. Pearl Joy J. Amuan")
content = content.replace("Ma. Elena Balleza", "Mrs. Pearl Joy J. Amuan")

# 2. Geography, 7 Puroks & 2025 Demographics
old_geo = "Barangay Dacutan is one of the coastal and agricultural barangays situated in the Municipality of Dumangas, Province of Iloilo, under Region VI (Western Visayas). The community is divided into seven puroks and two sitios, namely Purok 1 to Purok 7, Sitio Ilawod, and Sitio Ilaya."
new_geo = (
    "Barangay Dacutan is one of the coastal and agricultural barangays situated in the Municipality of Dumangas, "
    "Province of Iloilo, under Region VI (Western Visayas). Geographically located approximately 2.5 kilometers from the "
    "municipal poblacion with an aggregate land area of 230.7171 hectares, the barangay is bounded on the North by Barangay Sulangan "
    "and Barangay Binaobao, on the South by coastal fishing waters, on the East by Barangay Talusan and Barangay Sapao, "
    "and on the West by Barangay Ermita. Administratively, the community is organized strictly into seven (7) puroks, designated "
    "as Purok 1 through Purok 7. According to the official 2025 Barangay Demographic Profile, Barangay Dacutan has a total "
    "population of 2,337 residents (comprising 1,142 males and 1,195 females), distributed across 678 families and 562 households. "
    "The community includes significant special sectors: 556 senior citizens (aged 60 and above), 69 persons with disabilities (PWDs), "
    "1,445 registered COMELEC voters, 69 Pantawid Pamilyang Pilipino Program (4Ps) beneficiaries, 75 overseas Filipino workers (OFWs), "
    "52 registered farmers, and 146 active fisherfolks. Frontline regulatory and administrative governance is administered "
    "pursuant to Republic Act No. 7160 (Local Government Code of 1991) and Barangay Ordinance No. 2020-01 ('An Ordinance Enacting the "
    "Barangay Tax and Regulatory Fees of Barangay Dacutan, Dumangas, Iloilo'), enacted by the Sangguniang Barangay under the leadership "
    "of Punong Barangay Hon. Stephen James D. Foerster and Barangay Secretary Mrs. Pearl Joy J. Amuan."
)
content = content.replace(old_geo, new_geo)

# 3. Background of Study / OTP Compromise (Email Only)
old_bg_otp = "**One-Time Pin (OTP) Verification via SMS or Email**. When a resident completes the online document request and appointment form, the system dispatches a transient 4-digit code to their active mobile phone or email. Entering this code verifies that the requestor is a genuine individual with an active contact number, eliminating fake submissions without forcing residents to register and manage password-protected accounts."
new_bg_otp = "**One-Time Pin (OTP) Verification via Email**. When a resident completes the online document request and appointment form, the system dispatches a transient 4-digit numeric code to their active email address. Entering this code verifies that the requestor is a genuine individual with an active email inbox, eliminating fake submissions without forcing residents to register and manage password-protected accounts."
content = content.replace(old_bg_otp, new_bg_otp)

# 4. Objectives of Study
old_obj3 = "secured through an One-Time Pin (OTP) verification mechanism via SMS or Email that transmits a 4-digit code to validate active contact numbers and eliminate fake/spam entries without requiring password-based account registration"
new_obj3 = "secured through an One-Time Pin (OTP) verification mechanism via Email that transmits a transient 4-digit numeric code to validate active email addresses and eliminate fake/spam entries without requiring password-based account registration"
content = content.replace(old_obj3, new_obj3)

old_obj4 = "•  record and monitor resident census records with complete demographic details, purok classifications, and special sector eligibility flags such as Senior Citizens, PWDs, 4Ps members, and registered voters;"
new_obj4 = "•  record and monitor resident census records with complete demographic details across the seven (7) puroks of Barangay Dacutan, and track special sector eligibility flags including Senior Citizens, PWDs, 4Ps members, Solo Parents, Farmers, Fisherfolks, and registered COMELEC voters;"
content = content.replace(old_obj4, new_obj4)

# 5. Conceptual Framework Paragraphs (Remove ## * prefix and update text)
old_cf_input = "## *The conceptual framework of the study, presented in Figure 1, follows the Input-Process-Output (IPO) model, which outlines the flow of activities involved in developing the Barangay Information and Management System for Barangay Dacutan, Dumangas, Iloilo. The input stage consists of the essential data and information required by the system, including administrative user information, resident census information, document request and appointment information (including citizen contact numbers and 4-digit OTP verification codes), blotter incident information, and calamity aid information. These inputs serve as the foundation for the system’s operations and ensure that all processes are based on complete and accurate community data.*"
new_cf_input = (
    "The conceptual framework of the study, presented in Figure 1, follows the Input-Process-Output (IPO) model, "
    "which outlines the flow of activities involved in developing the Barangay Information and Management System for "
    "Barangay Dacutan, Dumangas, Iloilo. The input stage consists of the essential data and information required by the system, "
    "including administrative leadership profiles of Punong Barangay Hon. Stephen James D. Foerster and Barangay Secretary "
    "Mrs. Pearl Joy J. Amuan, official resident census records across the seven (7) puroks of Barangay Dacutan (totaling 2,337 residents, "
    "678 families, and 562 households with demographic sector flags for senior citizens, PWDs, 4Ps, farmers, and fisherfolks), "
    "citizen online document request and appointment information under Barangay Ordinance No. 2020-01 (including active applicant "
    "email addresses and transient 4-digit Email OTP verification codes), Lupon Tagapamayapa dispute blotter records, and emergency "
    "calamity aid distribution logs. These inputs serve as the foundation for the system's operations and ensure that all processes "
    "are based on complete and accurate community data."
)
content = content.replace(old_cf_input, new_cf_input)

old_cf_process = "## *The process stage involves the core activities needed to transform the inputs into the desired system outputs. These include managing administrative user accounts, authenticating citizen appointment requests through 4-digit OTP verification via SMS or email to prevent spam without password registration, registering and managing resident records, processing document requests through a two-tier clerical review and executive approval hierarchy, managing blotter and dispute records, recording calamity aid distribution, and generating system reports. These processes are designed to ensure that the system operates efficiently, provides reliable records, and speeds up daily administrative tasks at the barangay hall.*"
new_cf_process = (
    "The process stage involves the core activities needed to transform the inputs into the desired system outputs through "
    "the Prototyping Model methodology. These include managing administrative user accounts, authenticating citizen appointment "
    "requests through 4-digit OTP verification via Email to prevent spam without password registration, registering and managing "
    "resident records across the seven puroks, processing document requests through a two-tier clerical review by the Barangay "
    "Secretary and executive approval by the Punong Barangay, recording official regulatory fees and statutory exemptions pursuant "
    "to Barangay Ordinance No. 2020-01, managing blotter dispute mediation records, logging calamity relief distribution, dispatching "
    "automated SMTP email status updates, generating authentic Philippine Republic standard A4 clearances, and conducting ISO 25010 "
    "software quality evaluation."
)
content = content.replace(old_cf_process, new_cf_process)

old_cf_output = "## *The output of the framework is the Barangay Information and Management System, a functional web-based system that modernizes public service delivery in Barangay Dacutan. To ensure the system’s quality and dependability, the framework includes a system evaluation phase, where the developed system is assessed using the ISO/IEC 25010 software quality model across functional suitability, performance efficiency, compatibility, usability, reliability, security, maintainability, and portability. The results of the evaluation serve as feedback, guiding further improvements by refining inputs and processes to better serve the community.*"
new_cf_output = (
    "As reflected in the conceptual diagram, the output of the framework is strictly and solely the completed software deliverable: "
    "the **Barangay Information and Management System (BIMS)**. The framework illustrates an orthogonal, straight-line architectural flow "
    "where verified inputs pass through prototyping processes to deliver the unified web system, interconnected with a continuous "
    "evaluation feedback loop. To ensure the system's operational dependability and excellence, the system is assessed using the "
    "ISO/IEC 25010 software quality model across functional suitability, performance efficiency, compatibility, usability, reliability, "
    "security, maintainability, and portability, with evaluation feedback continuously channeled back to refine system operations."
)
content = content.replace(old_cf_output, new_cf_output)

# 6. Definition of Terms
content = content.replace("transmitted via SMS or email to verify that an applicant possesses an active, valid contact number", "transmitted via email to verify that an applicant possesses an active, valid email address")
content = content.replace("specifically Purok 1 through Purok 7, Sitio Ilawod, and Sitio Ilaya, used for filtering resident records and demographic charts.", "specifically Purok 1 through Purok 7, used for filtering resident records, mapping demographics, and generating community analytics.")

# 7. Significance of the Study
old_sig_captain = "Punong Barangay (Barangay Captain). The system provides the barangay captain with an executive dashboard showing real-time demographic statistics, monthly revenue collection totals, pending dispute rates, and active citizen applications. This helps leadership make informed, timely decisions and plan local projects with accurate population data."
new_sig_captain = "Punong Barangay (Barangay Captain). The system provides Punong Barangay Hon. Stephen James D. Foerster with an executive dashboard showing real-time demographic statistics across the 7 puroks, monthly revenue collections under Ordinance No. 2020-01, pending dispute rates, and active citizen clearance requests. This provides executive visibility, accelerates Tier-2 clearance approvals, and supports accurate data-driven community planning."
content = content.replace(old_sig_captain, new_sig_captain)

old_sig_sec = "Barangay Secretary (and Clerical Staff). The system significantly lessens the daily administrative and clerical workload of the secretary. Instead of manually searching through physical logbooks and index cards, the secretary can verify resident records in seconds, process online clearance requests across 12 document categories, record official receipts, and monitor mediation schedules with automated tracking numbers. In addition, because the system employs lightweight 4-digit OTP verification on appointment requests rather than mandatory citizen account registration, the secretary is completely relieved from the administrative burden of managing citizen login accounts, handling forgotten password requests, and cleaning up spam submissions."
new_sig_sec = "Barangay Secretary (and Clerical Staff). The system significantly lessens the daily administrative and clerical workload of Barangay Secretary Mrs. Pearl Joy J. Amuan. Instead of manually searching through physical logbooks and paper cards, the secretary can verify resident records in seconds, process online clearance requests across official document offerings, record official receipts and CTC numbers, and monitor mediation schedules with automated tracking numbers. In addition, because the system employs lightweight 4-digit OTP verification via email on appointment requests rather than mandatory citizen account registration, the secretary is completely relieved from the administrative burden of managing citizen login accounts, handling forgotten password requests, and cleaning up spam submissions."
content = content.replace(old_sig_sec, new_sig_sec)

content = content.replace("verifying their identity easily through a 4-digit OTP sent to their mobile phone or email.", "verifying their identity easily through a 4-digit OTP sent to their verified email inbox.")

# 8. Scope and Limitations
content = content.replace("specifically covering all residential households situated across Purok 1 through Purok 7, Sitio Ilawod, and Sitio Ilaya.", "specifically covering all residential households situated across Purok 1 through Purok 7.")
content = content.replace("verification mechanism via SMS or Email that validates the applicant's active contact number prior to official submission.", "verification mechanism via Email that validates the applicant's active email address prior to official submission pursuant to Barangay Ordinance No. 2020-01.")
content = content.replace("password-based user accounts are strictly restricted to authorized administrative personnel (Punong Barangay and Barangay Secretary), whereas citizen requestors authenticate their appointments on demand via 4-digit OTP.", "password-based user accounts are strictly restricted to authorized administrative personnel (Punong Barangay Hon. Stephen James D. Foerster and Barangay Secretary Mrs. Pearl Joy J. Amuan), whereas citizen requestors authenticate their appointments on demand via 4-digit Email OTP.")

old_lim = "The system is limited to web-based access and does not include a native downloadable mobile application. Users must access the system through modern desktop or mobile web browsers. Cellular SMS messaging is specifically focused on sending short, transient 4-digit OTP verification codes to validate applicant contact numbers upon submission, while general status milestone updates and clearance pickup notices are dispatched via automated SMTP email notifications and the public online tracking portal to minimize ongoing SMS gateway overhead. The system does not include an online electronic payment gateway, such as GCash or Maya, so all document fees are collected personally in cash at the barangay hall upon claiming, recorded with manual Official Receipt and Community Tax Certificate numbers. Furthermore, the application is strictly designed for the administrative jurisdiction and demographic records of Barangay Dacutan, Dumangas, Iloilo, and does not automatically integrate with external municipal or national police law enforcement databases."
new_lim = (
    "The system is limited to web-based access and does not include a native downloadable mobile application. Users access the system "
    "through modern desktop or mobile web browsers. To prevent ongoing telecommunication overhead and recurring subscriber costs, "
    "the system does not utilize cellular SMS text messaging; instead, all identity verification operations (4-digit Email OTP), "
    "milestone status tracking, and clearance pickup notifications are dispatched through automated SMTP email notifications and "
    "the public online tracking portal. The system does not include an online electronic payment gateway, such as GCash or Maya, "
    "so all document fees are collected personally in cash at the barangay hall upon claiming, recorded with manual Official Receipt (OR) "
    "and Community Tax Certificate (CTC) numbers pursuant to Barangay Ordinance No. 2020-01. Furthermore, the application is strictly "
    "designed for the administrative jurisdiction and demographic records of Barangay Dacutan, Dumangas, Iloilo, and does not "
    "automatically integrate with external municipal or national police law enforcement databases."
)
content = content.replace(old_lim, new_lim)

# 9. Chapter III Roles and Modules
content = content.replace("authenticated via a 4-digit OTP sent to their mobile phone or email without needing password registration", "authenticated via a 4-digit OTP sent to their email inbox without needing password registration")
content = content.replace("Punong Barangay (Barangay Captain): The executive leader who monitors demographic indicators, approves certificate releases, oversees Lupon disputes, and authorizes official certifications.", "Punong Barangay (Hon. Stephen James D. Foerster): The executive leader who monitors demographic indicators, approves certificate releases (Tier-2 approval), oversees Lupon disputes, and authorizes official certifications.")
content = content.replace("Barangay Secretary (Administrative & Records Officer): The operational administrator who also executes general clerical routine work, including resident encoding, certificate evaluation, fee/OR logging, blotter mediation tracking, and calamity aid registry.", "Barangay Secretary (Mrs. Pearl Joy J. Amuan): The operational administrator and records officer who also executes general clerical routines, including census resident encoding across the 7 puroks, certificate evaluation (Tier-1 review), fee/OR logging under Ordinance No. 2020-01, blotter mediation tracking, and calamity aid registry.")

content = content.replace("secured by 4-digit One-Time Pin (OTP) verification via SMS or Email (validating active contact numbers to eliminate spam without requiring user passwords)", "secured by 4-digit One-Time Pin (OTP) verification via Email (validating active email addresses to eliminate spam without requiring user passwords)")

# 10. Diagram placeholders & narrative
content = content.replace("Verify 4-Digit OTP (SMS/Email)", "Verify 4-Digit OTP via Email")
content = content.replace("Diagram Placeholder: [Resident Fills Online Appointment Form & Inputs Mobile/Email] ---> [System Generates & Transmits 4-Digit OTP via SMS/Email]", "Diagram Placeholder: [Resident Fills Online Appointment Form & Inputs Email Address] ---> [System Generates & Transmits 4-Digit OTP via Automated SMTP Email]")
content = content.replace("Messaging Services: SMS Gateway (4-Digit OTP) & SMTP Email Dispatcher", "Messaging Services: Automated Email & OTP Dispatcher Service (SMTP)")

# Replace placeholder boxes with actual markdown image embeds where appropriate
fig1_old = """*Figure 1. Conceptual Framework of the Study (IPO Model)*"""
fig1_new = """![Figure 1. Conceptual Framework of the Study (IPO Model)](Diagrams/figure1_conceptual_framework.png)\n\n*Figure 1. Conceptual Framework of the Study (IPO Model)*"""
if "Diagrams/figure1_conceptual_framework.png" not in content:
    content = content.replace(fig1_old, fig1_new)

fig2_old = """*Figure 2. Prototyping Model Software Development Life Cycle*"""
fig2_new = """![Figure 2. Prototyping Model Software Development Life Cycle](Diagrams/figure2_prototyping_model.png)\n\n*Figure 2. Prototyping Model Software Development Life Cycle*"""
if "Diagrams/figure2_prototyping_model.png" not in content:
    content = content.replace(fig2_old, fig2_new)

fig3_old = """*Figure 3. Use Case Diagram of the Barangay Information Management System*"""
fig3_new = """![Figure 3. Use Case Diagram of the Barangay Information Management System](Diagrams/figure3_use_case_diagram.png)\n\n*Figure 3. Use Case Diagram of the Barangay Information Management System*"""
if "Diagrams/figure3_use_case_diagram.png" not in content:
    content = content.replace(fig3_old, fig3_new)

fig4_old = """*Figure 4. Activity Diagram for Online Clearance Application and Issuance*"""
fig4_new = """![Figure 4. Activity Diagram for Online Clearance Application and Issuance](Diagrams/figure4_activity_diagram.png)\n\n*Figure 4. Activity Diagram for Online Clearance Application and Issuance*"""
if "Diagrams/figure4_activity_diagram.png" not in content:
    content = content.replace(fig4_old, fig4_new)

fig5_old = """*Figure 5. Class Diagram / Database Schema of BIMS*"""
fig5_new = """![Figure 5. Class Diagram / Database Schema of BIMS](Diagrams/figure5_class_diagram.png)\n\n*Figure 5. Class Diagram / Database Schema of BIMS*"""
if "Diagrams/figure5_class_diagram.png" not in content:
    content = content.replace(fig5_old, fig5_new)

fig6_old = """*Figure 6. Sequence Diagram for Citizen Document Tracking Flow*"""
fig6_new = """![Figure 6. Sequence Diagram for Citizen Document Tracking Flow](Diagrams/figure6_sequence_diagram.png)\n\n*Figure 6. Sequence Diagram for Citizen Document Tracking Flow*"""
if "Diagrams/figure6_sequence_diagram.png" not in content:
    content = content.replace(fig6_old, fig6_new)

fig7_old = """*Figure 7. System Architecture Diagram of the BIMS Live Cloud Web Deployment*"""
fig7_new = """![Figure 7. System Architecture Diagram of the BIMS Live Cloud Web Deployment](Diagrams/figure7_system_architecture.png)\n\n*Figure 7. System Architecture Diagram of the BIMS Live Cloud Web Deployment*"""
if "Diagrams/figure7_system_architecture.png" not in content:
    content = content.replace(fig7_old, fig7_new)

# General cleanup of any lingering SMS / Sitio
content = content.replace("SMS or Email", "Email")
content = content.replace("SMS or email", "email")
content = content.replace("SMS/Email", "Email")
content = content.replace("via SMS", "via Email")
content = content.replace("mobile phone or email", "email address")
content = content.replace("Sitio Ilawod, and Sitio Ilaya", "")
content = content.replace("Sitio Ilawod and Sitio Ilaya", "")
content = content.replace("Purok 1 through Purok 7, Sitio Ilawod, and Sitio Ilaya", "Purok 1 through Purok 7")
content = content.replace("Purok 1 to Purok 7, Sitio Ilawod, and Sitio Ilaya", "Purok 1 to Purok 7")

with open(md_path, "w", encoding="utf-8") as f:
    f.write(content)

print("Updated Markdown manuscript:", md_path)

