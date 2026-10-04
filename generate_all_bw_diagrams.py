import os
import plantuml
from PIL import Image

output_dir = os.path.abspath('Documentation/Diagrams')
os.makedirs(output_dir, exist_ok=True)
p = plantuml.PlantUML(url='http://www.plantuml.com/plantuml/img/')

# Common Black & White skinparams (standard resolution, no 4096px clipping)
BW_SKIN = """
skinparam defaultFontName "Segoe UI"
skinparam shadowing false
skinparam monochrome true
skinparam roundCorner 4
skinparam ArrowColor #000000
skinparam ArrowThickness 1.3
skinparam DefaultFontColor #000000
"""

# ==========================================
# 1. FIGURE 1: CONCEPTUAL FRAMEWORK (IPO)
# ==========================================
puml_fig1 = f"""@startuml
{BW_SKIN}

skinparam rectangle {{
    BackgroundColor #FFFFFF
    BorderColor #000000
    BorderThickness 1.5
    FontColor #000000
    FontSize 11
}}

rectangle "**INPUT**\\n\\n**Resident Information**\\n• Full Name, Birthday, Gender, Civil Status\\n• Residence Address & Purok Mapping\\n• Sector Flags (Senior, PWD, 4Ps, Indigent)\\n\\n**Document Request Information**\\n• 12 Clearance & Certificate Types\\n• Purpose of Request & Requirements\\n• Citizen Contact Email Address\\n\\n**Barangay Operations Data**\\n• Blotter Incidents & Lupon Hearings\\n• Calamity & SAP Aid Distributions\\n• Official Receipt (OR) & CTC Numbers\\n\\n**Administrative Data**\\n• Staff Credentials & Access Roles" as Input

rectangle "**PROCESS**\\n\\n**Phase 1: Planning & Analysis**\\n• Needs Assessment in Brgy Dacutan\\n• Frontline Service Workflow Analysis\\n• Hardware & Software Specification\\n\\n**Phase 2: Prototyping & Development**\\n• Full-Stack Web App (Laravel 12 & MySQL)\\n• 24/7 Citizen Web Portal & Requesting\\n• 2-Tier Approval Hierarchy\\n  (Secretary Review & Captain Approval)\\n• Automated SMTP Email Notifications\\n• Dual-Seal Standard A4 Clearance Generator\\n\\n**Phase 3: Testing & Evaluation**\\n• Component & Integration Testing\\n• ISO 25010 Quality Evaluation" as Process

rectangle "**OUTPUT**\\n\\n**Barangay Information and**\\n**Management System (BIMS)**\\n**for Barangay Dacutan, Dumangas**\\n\\n• 24/7 Public Citizen Web Portal\\n• 12 Online Document Offerings\\n• 4-Stage Real-Time Request Tracker\\n• Automated Status Email Notifications\\n• 2-Tier Clearance Approval Hierarchy\\n• Centralized Resident Census Profiling\\n• Blotter & Lupon Case Management\\n• Calamity & SAP Relief Distribution\\n• Authentic Republic Standard A4 Clearances" as Output

rectangle "**FEEDBACK & CONTINUOUS EVALUATION**\\nISO 25010 Software Quality Evaluation & Frontline Community User Feedback" as Feedback

Input -right-> Process : " System Processing\\n & Data Flow "
Process -right-> Output : " System Deliverables\\n & Deployment "

Output -down-> Feedback
Feedback -left-> Input

@enduml
"""

# ==========================================
# 2. FIGURE 2: PROTOTYPING MODEL (SDLC)
# ==========================================
puml_fig2 = f"""@startuml
{BW_SKIN}
skinparam rectangle {{
    BackgroundColor #FFFFFF
    BorderColor #000000
    BorderThickness 1.5
    FontColor #000000
    FontSize 11
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

# ==========================================
# 3. FIGURE 3: USE CASE DIAGRAM
# ==========================================
puml_fig3 = f"""@startuml
{BW_SKIN}

left to right direction

skinparam actor {{
    BackgroundColor #FFFFFF
    BorderColor #000000
    BorderThickness 1.5
    FontColor #000000
    FontSize 11
    FontStyle bold
}}

skinparam usecase {{
    BackgroundColor #FFFFFF
    BorderColor #000000
    BorderThickness 1.3
    FontColor #000000
    FontSize 10
}}

skinparam package {{
    BackgroundColor #FFFFFF
    BorderColor #000000
    BorderThickness 1.3
    FontColor #000000
    FontSize 11
    FontStyle bold
}}

skinparam rectangle {{
    BackgroundColor #FFFFFF
    BorderColor #000000
    BorderThickness 1.5
    FontColor #000000
    FontSize 12
    FontStyle bold
}}

actor "Resident / Citizen\\n(General Public)" as Resident
actor "Barangay Secretary\\n(Clerk & Records Officer)" as Secretary
actor "Punong Barangay\\n(Barangay Captain)" as Captain

rectangle "Barangay Information and Management System (BIMS)" {{

    package "Public Citizen Frontline Services" as P1 {{
        usecase "View Announcements & Hotlines" as UC1
        usecase "Apply for Clearances (12 Types)" as UC2
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

' Resident Links
Resident --> UC1
Resident --> UC2
Resident --> UC3
UC2 ..> UC4 : <<include>>

' Secretary Links
Secretary --> UC5
Secretary --> UC6
Secretary --> UC7
Secretary --> UC8
Secretary --> UC9
Secretary --> UC10

' Captain Links
Captain --> UC11
Captain --> UC12
Captain --> UC13
Captain --> UC14

' Vertical order of actors matching packages
Resident -[hidden]down- Secretary
Secretary -[hidden]down- Captain

@enduml
"""

# ==========================================
# 4. FIGURE 4: ACTIVITY DIAGRAM
# ==========================================
puml_fig4 = f"""@startuml
{BW_SKIN}

skinparam activity {{
    BackgroundColor #FFFFFF
    BorderColor #000000
    BorderThickness 1.3
    FontColor #000000
    FontSize 10
}}

skinparam partition {{
    BackgroundColor #FFFFFF
    BorderColor #000000
    BorderThickness 1.4
    FontColor #000000
    FontSize 11
    FontStyle bold
}}

skinparam condition {{
    BackgroundColor #FFFFFF
    BorderColor #000000
    BorderThickness 1.3
    FontColor #000000
    FontSize 10
}}

|Resident / Citizen|
start
:Access Public Citizen Portal;
:Fill out online request form\\n(select from 12 document offerings);
:Enter email address & request purpose;
:Submit document request online;

|BIMS Web System & Mailer|
:Validate input fields;
:Generate unique 8-character\\ntracking reference code;
:Record application as "Submitted";
:Send automated Confirmation Email\\nwith tracking reference code;

|Barangay Secretary (Clerk)|
:Log in to Administrative Dashboard;
:Open Pending Request queue;
:Inspect applicant against Census\\nProfiles & Blotter Records;

if (Application valid & complete?) then (no)
    :Reject application with remarks;
    |BIMS Web System & Mailer|
    :Update status to "Rejected";
    :Send Rejection Notice email;
    |Resident / Citizen|
    :Receive rejection email;
    stop
else (yes)
    |Barangay Secretary (Clerk)|
    :Endorse request (Tier 1 completed);
    |BIMS Web System & Mailer|
    :Update status to "Evaluated";
    :Send Evaluation Notice email;
endif

|Punong Barangay (Captain)|
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
    |Punong Barangay (Captain)|
    :Authorize executive approval (Tier 2);
    |BIMS Web System & Mailer|
    :Update status to "Approved";
    :Send Captain Approval Notice email;
endif

|Barangay Secretary (Clerk)|
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

# ==========================================
# 5. FIGURE 5: CLASS DIAGRAM / DATABASE SCHEMA
# ==========================================
puml_fig5 = f"""@startuml
{BW_SKIN}

skinparam class {{
    BackgroundColor #FFFFFF
    BorderColor #000000
    BorderThickness 1.4
    FontColor #000000
    FontSize 11
    AttributeFontSize 10
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

# ==========================================
# 6. FIGURE 6: SEQUENCE DIAGRAM
# ==========================================
puml_fig6 = f"""@startuml
{BW_SKIN}
skinparam sequence {{
    ArrowColor #000000
    ArrowThickness 1.3
    ActorBorderColor #000000
    ActorBorderThickness 1.5
    ActorBackgroundColor #FFFFFF
    ParticipantBorderColor #000000
    ParticipantBorderThickness 1.5
    ParticipantBackgroundColor #FFFFFF
    ParticipantFontSize 11
    ParticipantFontColor #000000
    LifeLineBorderColor #000000
    LifeLineBorderThickness 1.2
    LifeLineBackgroundColor #FFFFFF
}}

skinparam alt {{
    BackgroundColor #FFFFFF
    BorderColor #000000
    BorderThickness 1.5
    FontColor #000000
    FontSize 11
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

# ==========================================
# 7. FIGURE 7: SYSTEM ARCHITECTURE DIAGRAM
# ==========================================
puml_fig7 = f"""@startuml
{BW_SKIN}

skinparam node {{
    BackgroundColor #FFFFFF
    BorderColor #000000
    BorderThickness 1.4
    FontColor #000000
    FontSize 11
    FontStyle bold
}}

skinparam rectangle {{
    BackgroundColor #FFFFFF
    BorderColor #000000
    BorderThickness 1.3
    FontColor #000000
    FontSize 10
}}

skinparam cloud {{
    BackgroundColor #FFFFFF
    BorderColor #000000
    BorderThickness 1.4
    FontColor #000000
    FontSize 11
    FontStyle bold
}}

skinparam database {{
    BackgroundColor #FFFFFF
    BorderColor #000000
    BorderThickness 1.4
    FontColor #000000
    FontSize 11
    FontStyle bold
}}

rectangle "1. PRESENTATION / CLIENT TIER" as ClientTier {{
    node "Public Citizen Access" as CitizenDev {{
        rectangle "Responsive Web Browser\\n• Mobile Phones (Android / iOS)\\n• Laptops & Personal Computers" as CitizenApp
    }}
    
    node "Barangay Hall Workstations" as AdminDev {{
        rectangle "Administrative Terminals\\n• Secretary Desktop PC\\n• Punong Barangay Office Terminal\\n• Network Laser Printer" as AdminApp
    }}
}}

cloud "2. NETWORK & SECURITY TIER" as Internet {{
    rectangle "Public Internet & Secure HTTPS Protocol (Port 443)\\n256-bit SSL / TLS Certificate Data Encryption" as SecurityLayer
}}

node "3. APPLICATION & SERVICE TIER (LIVE CLOUD HOSTING)" as CloudServer {{
    rectangle "Web Server Stack\\n• Linux OS (Ubuntu 22.04 LTS)\\n• Nginx / Apache HTTP Engine\\n• PHP 8.2+ FastCGI" as WebServer
    
    rectangle "Laravel 12 Backend Application\\n• HTTP Routing & Authentication Middleware\\n• Eloquent ORM & Relational Business Logic\\n• Blade Templates & Responsive UI" as AppLayer
    
    rectangle "Automated Mailer Service\\n• SMTP Protocol Integration\\n• Real-Time Notification Dispatcher" as MailService
}}

node "4. DATA STORAGE TIER" as DBTier {{
    database "MySQL 8.0 Relational DBMS" as MySQL {{
        rectangle "Relational Database Tables\\n• residents (demographic & census data)\\n• certificates (12 document types & tracking)\\n• blotter_records (dispute & mediation logs)\\n• aid_distributions (relief & SAP distributions)\\n• users (role-based staff credentials)" as Tables
    }}
}}

ClientTier -down-> Internet : " Encrypted HTTPS Traffic (Port 443) "
Internet -down-> WebServer : " Secure Web Requests "
WebServer -right-> AppLayer : " FastCGI / PHP "
AppLayer -right-> MailService : " Dispatch Status Emails "
AppLayer -down-> MySQL : " SQL Queries & Record Sets "

@enduml
"""

diagram_definitions = [
    ("figure1_conceptual_framework", puml_fig1),
    ("figure2_prototyping_model", puml_fig2),
    ("figure3_use_case_diagram", puml_fig3),
    ("figure4_activity_diagram", puml_fig4),
    ("figure5_class_diagram", puml_fig5),
    ("figure6_sequence_diagram", puml_fig6),
    ("figure7_system_architecture", puml_fig7)
]

for name, content in diagram_definitions:
    puml_path = os.path.join(output_dir, f"{name}.puml")
    png_path = os.path.join(output_dir, f"{name}.png")
    
    with open(puml_path, "w", encoding="utf-8") as f:
        f.write(content)
    
    try:
        png_bytes = p.processes(content)
        with open(png_path, "wb") as f:
            f.write(png_bytes)
        im = Image.open(png_path)
        print(f"Generated: {name}.png | Dimensions: {im.size} | {len(png_bytes)} bytes")
    except Exception as e:
        print(f"Error generating {name}: {e}")

print("All 7 official B&W diagrams generated successfully.")
