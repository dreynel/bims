/**
 * BIMS Barangay Dacutan - Comprehensive Mock Dataset
 * Tailored for Dumangas, Iloilo
 */

const BIMS_DATA = {
  barangayInfo: {
    name: "Barangay Dacutan",
    municipality: "Dumangas",
    province: "Iloilo",
    region: "Region VI (Western Visayas)",
    zipCode: "5006",
    captain: "Hon. Roberto D. Dacutan",
    secretary: "Mrs. Ma. Elena Balleza",
    treasurer: "Mr. Jose Mari Demaisip",
    contactNo: "(033) 396-1024 / 0917-889-9123",
    email: "info@dacutan.dumangas.gov.ph",
    hallAddress: "Barangay Hall, Main Road, Barangay Dacutan, Dumangas, Iloilo",
    tagline: "Dunong, Pag-ugwad, kag Paghiliusa sa Dacutan"
  },

  officials: [
    { name: "Hon. Roberto D. Dacutan", role: "Punong Barangay", committee: "Overall Executive Governance & Peace and Order", avatar: "https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?auto=format&fit=crop&w=150&q=80" },
    { name: "Hon. Arnel B. Defensor", role: "Barangay Kagawad", committee: "Committee on Peace & Order / Lupon Tagapamayapa", avatar: "https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=150&q=80" },
    { name: "Hon. Maria Teresa S. Balleza", role: "Barangay Kagawad", committee: "Committee on Health, Sanitation & Social Welfare", avatar: "https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=150&q=80" },
    { name: "Hon. Rommel J. Demaisip", role: "Barangay Kagawad", committee: "Committee on Agriculture, Fisheries & Food Security", avatar: "https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=150&q=80" },
    { name: "Hon. Carmen L. Villanueva", role: "Barangay Kagawad", committee: "Committee on Appropriations, Budget & Finance", avatar: "https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&w=150&q=80" },
    { name: "Hon. Jose Marie G. Tupas", role: "Barangay Kagawad", committee: "Committee on Infrastructure, Public Works & Roads", avatar: "https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?auto=format&fit=crop&w=150&q=80" },
    { name: "Hon. Antonio P. Alcantara", role: "Barangay Kagawad", committee: "Committee on Education, Culture & Heritage", avatar: "https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?auto=format&fit=crop&w=150&q=80" },
    { name: "Hon. Nelson V. Solis", role: "Barangay Kagawad", committee: "Committee on Environment, Climate & Disaster Preparedness", avatar: "https://images.unsplash.com/photo-1522075469751-3a6694fb2f61?auto=format&fit=crop&w=150&q=80" },
    { name: "Hon. Bea Andrea C. Divinagracia", role: "SK Chairperson", committee: "Committee on Youth & Sports Development", avatar: "https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=150&q=80" },
    { name: "Mrs. Ma. Elena Balleza", role: "Barangay Secretary", committee: "Administrative Records, Certificates & Archives", avatar: "https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=150&q=80" },
    { name: "Mr. Jose Mari Demaisip", role: "Barangay Treasurer", committee: "Barangay Revenues, Collections & Disbursements", avatar: "https://images.unsplash.com/photo-1463453091185-61582044d556?auto=format&fit=crop&w=150&q=80" }
  ],

  emergencyHotlines: [
    { title: "Dumangas Municipal Police (PNP)", number: "(033) 396-1211 / 0998-598-6241", badge: "24/7 Emergency", icon: "fa-shield-halved", color: "text-blue-600 bg-blue-50" },
    { title: "Bureau of Fire Protection (BFP Dumangas)", number: "(033) 396-1191 / 0917-123-4347", badge: "Fire & Rescue", icon: "fa-fire-extinguisher", color: "text-rose-600 bg-rose-50" },
    { title: "MDRRMO Dumangas Rescue", number: "(033) 396-1020 / 0920-911-3862", badge: "Disaster & Medical", icon: "fa-truck-medical", color: "text-amber-600 bg-amber-50" },
    { title: "Barangay Dacutan Tanod & BHERT Desk", number: "0917-889-9123 / (033) 396-1024", badge: "Barangay Hall", icon: "fa-walkie-talkie", color: "text-emerald-600 bg-emerald-50" },
    { title: "Dumangas Rural Health Unit (RHU)", number: "(033) 396-1033", badge: "Health Center", icon: "fa-hospital", color: "text-teal-600 bg-teal-50" }
  ],

  stats: {
    totalResidents: 2480,
    totalHouseholds: 512,
    seniorCitizens: 340,
    pwdCount: 88,
    indigentFamilies: 195,
    fourPsBeneficiaries: 142,
    registeredVoters: 1650,
    activeBlotters: 4,
    clearancesThisMonth: 128
  },

  puroks: [
    "Purok 1", "Purok 2", "Purok 3", "Purok 4", 
    "Purok 5", "Purok 6", "Purok 7", "Sitio Ilawod", "Sitio Ilaya"
  ],

  residents: [
    {
      id: 1,
      residentId: "DAC-2026-0001",
      firstName: "Juan",
      middleName: "Dela Cruz",
      lastName: "Dacutan",
      suffix: "",
      gender: "Male",
      birthDate: "1962-04-12",
      age: 64,
      civilStatus: "Married",
      purok: "Purok 1",
      address: "Main Road, Brgy. Dacutan",
      contactNo: "09171234567",
      occupation: "Rice Farmer",
      monthlyIncome: 8500,
      voterStatus: "Registered",
      precinct: "0012A",
      isSenior: true,
      isPwd: false,
      isIndigent: true,
      is4ps: true,
      isSoloParent: false,
      photo: "https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=200&q=80"
    },
    {
      id: 2,
      residentId: "DAC-2026-0002",
      firstName: "Ma. Teresa",
      middleName: "Solis",
      lastName: "Balleza",
      suffix: "",
      gender: "Female",
      birthDate: "1985-09-18",
      age: 40,
      civilStatus: "Married",
      purok: "Purok 3",
      address: "Coastal Zone, Brgy. Dacutan",
      contactNo: "09198881234",
      occupation: "Public School Teacher",
      monthlyIncome: 27000,
      voterStatus: "Registered",
      precinct: "0014B",
      isSenior: false,
      isPwd: false,
      isIndigent: false,
      is4ps: false,
      isSoloParent: false,
      photo: "https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=200&q=80"
    },
    {
      id: 3,
      residentId: "DAC-2026-0003",
      firstName: "Ramon",
      middleName: "Gonzales",
      lastName: "Bautista",
      suffix: "Jr.",
      gender: "Male",
      birthDate: "1988-11-03",
      age: 37,
      civilStatus: "Single",
      purok: "Purok 2",
      address: "Riverside St., Brgy. Dacutan",
      contactNo: "09205551234",
      occupation: "Fisherman",
      monthlyIncome: 7200,
      voterStatus: "Registered",
      precinct: "0013A",
      isSenior: false,
      isPwd: true,
      isIndigent: true,
      is4ps: true,
      isSoloParent: false,
      photo: "https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=200&q=80"
    },
    {
      id: 4,
      residentId: "DAC-2026-0004",
      firstName: "Elena",
      middleName: "Palma",
      lastName: "Villanueva",
      suffix: "",
      gender: "Female",
      birthDate: "1995-02-14",
      age: 31,
      civilStatus: "Single",
      purok: "Sitio Ilawod",
      address: "Lower Ilawod, Brgy. Dacutan",
      contactNo: "09993334444",
      occupation: "Sari-Sari Store Owner",
      monthlyIncome: 14500,
      voterStatus: "Registered",
      precinct: "0015A",
      isSenior: false,
      isPwd: false,
      isIndigent: false,
      is4ps: false,
      isSoloParent: true,
      photo: "https://images.unsplash.com/photo-1580489944761-15a19d654956?auto=format&fit=crop&w=200&q=80"
    },
    {
      id: 5,
      residentId: "DAC-2026-0005",
      firstName: "Pedro",
      middleName: "Alcantara",
      lastName: "Demaisip",
      suffix: "",
      gender: "Male",
      birthDate: "1955-09-30",
      age: 70,
      civilStatus: "Widowed",
      purok: "Purok 4",
      address: "Purok 4 Central, Brgy. Dacutan",
      contactNo: "09124445555",
      occupation: "Retired Carpenter",
      monthlyIncome: 4500,
      voterStatus: "Registered",
      precinct: "0016B",
      isSenior: true,
      isPwd: false,
      isIndigent: true,
      is4ps: false,
      isSoloParent: false,
      photo: "https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?auto=format&fit=crop&w=200&q=80"
    },
    {
      id: 6,
      residentId: "DAC-2026-0006",
      firstName: "Mark Anthony",
      middleName: "Defensor",
      lastName: "Perez",
      suffix: "",
      gender: "Male",
      birthDate: "2004-06-21",
      age: 22,
      civilStatus: "Single",
      purok: "Purok 5",
      address: "Purok 5 North, Brgy. Dacutan",
      contactNo: "09981112233",
      occupation: "IT Student / Fresh Grad",
      monthlyIncome: 0,
      voterStatus: "Registered",
      precinct: "0017A",
      isSenior: false,
      isPwd: false,
      isIndigent: true,
      is4ps: true,
      isSoloParent: false,
      photo: "https://images.unsplash.com/photo-1539571696357-5a69c17a67c6?auto=format&fit=crop&w=200&q=80"
    }
  ],

  certificates: [
    {
      id: 101,
      controlNo: "CLR-2026-08001",
      residentName: "Juan Dela Cruz Dacutan",
      residentId: "DAC-2026-0001",
      type: "Barangay Clearance",
      purpose: "Postal ID & Local Employment",
      amountPaid: "₱ 50.00",
      orNumber: "OR-99812",
      issuedBy: "Mrs. Ma. Elena Balleza",
      issueDate: "2026-08-20",
      status: "Issued"
    },
    {
      id: 102,
      controlNo: "IND-2026-08014",
      residentName: "Ramon Gonzales Bautista Jr.",
      residentId: "DAC-2026-0003",
      type: "Certificate of Indigency",
      purpose: "Medical Assistance at Western Visayas Medical Center",
      amountPaid: "₱ 0.00 (Free)",
      orNumber: "EXEMPT",
      issuedBy: "Mrs. Ma. Elena Balleza",
      issueDate: "2026-08-25",
      status: "Issued"
    },
    {
      id: 103,
      controlNo: "JOB-2026-08005",
      residentName: "Mark Anthony Defensor Perez",
      residentId: "DAC-2026-0006",
      type: "First Time Job Seeker",
      purpose: "Pre-employment requirement (RA 11261 Waiver)",
      amountPaid: "₱ 0.00 (Free)",
      orNumber: "RA-11261",
      issuedBy: "Mrs. Ma. Elena Balleza",
      issueDate: "2026-08-26",
      status: "Issued"
    }
  ],

  blotterRecords: [
    {
      id: 201,
      caseNo: "BLT-2026-004",
      complainant: "Pedro Alcantara Demaisip",
      respondent: "Nonito 'Dodoy' Castor",
      incidentType: "Property Boundary & Stray Livestock",
      location: "Purok 4 Rice Fields, Dacutan",
      incidentDate: "2026-08-18 16:30",
      narrative: "Complainant alleged that respondent's stray cattle damaged his vegetable garden and banana plantation adjacent to the irrigation canal.",
      status: "In Mediation",
      presidingOfficer: "Hon. Roberto D. Dacutan",
      nextHearing: "2026-08-30 09:00 AM",
      aiSummary: "AI Mediation Tip: Recommend neighbor agreement under Municipal Agricultural Code regarding livestock tethering with partial crop damage settlement."
    },
    {
      id: 202,
      caseNo: "BLT-2026-003",
      complainant: "Elena Palma Villanueva",
      respondent: "Gerson Tupas",
      incidentType: "Late Night Videoke Noise Violation",
      location: "Lower Ilawod, Dacutan",
      incidentDate: "2026-08-12 23:45",
      narrative: "Loud videoke operation past 10:00 PM quiet hour ordinance.",
      status: "Settled",
      presidingOfficer: "Kagawad Arnel Defensor",
      nextHearing: "Resolved",
      aiSummary: "AI Status: Settled. Respondent agreed to respect the 10 PM curfew ordinance of Dumangas."
    }
  ],

  aidDistributions: [
    {
      id: 301,
      program: "LGU Dumangas Coastal Typhoone Aid Relief",
      date: "2026-08-10",
      beneficiary: "Ramon Gonzales Bautista Jr. (Purok 2)",
      assistanceType: "Food Pack & Water Supplies",
      qty: "2 Rice Packs + Hygiene Kit",
      status: "Claimed",
      recommender: "AI Vulnerability Matrix #1"
    },
    {
      id: 302,
      program: "Barangay Senior Citizen Financial Assistance",
      date: "2026-08-15",
      beneficiary: "Pedro Alcantara Demaisip (Purok 4)",
      assistanceType: "Cash Stipend",
      qty: "₱ 1,500.00",
      status: "Claimed",
      recommender: "Senior Citizen Registry"
    }
  ],

  aiInsights: [
    {
      title: "Senior Health Outreach Recommended",
      category: "Demographics & Health",
      priority: "High",
      icon: "heart-pulse",
      text: "Purok 4 and Sitio Ilawod have the highest concentration of low-income Senior Citizens (70+ yrs old). Recommend scheduling a Barangay Mobile Clinic visit."
    },
    {
      title: "Blotter Resolution Efficiency: 85%",
      category: "Katarungang Pambarangay",
      priority: "Medium",
      icon: "gavel",
      text: "9 out of 11 recorded disputes in 2026 were successfully resolved at the Barangay level without escalation to Dumangas PNP."
    },
    {
      title: "Calamity Relief Allocation Ready",
      category: "Financial Aid AI",
      priority: "High",
      icon: "sparkles",
      text: "AI has pre-filtered 195 verified indigent families for the upcoming Q3 Dumangas Agricultural Emergency Subsidy."
    }
  ]
};
