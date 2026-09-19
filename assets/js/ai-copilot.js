/**
 * BIMS Barangay Dacutan - AI Copilot & NLP Logic Engine
 */

const AI_COPILOT = {
  language: 'en', // 'en', 'hil', 'tl'

  setLanguage(lang) {
    this.language = lang;
  },

  processQuery(userInput) {
    const query = userInput.toLowerCase().trim();

    // 1. Demographics / Senior Citizens Query
    if (query.includes('senior') || query.includes('tigurulang') || query.includes('matanda')) {
      const seniors = BIMS_DATA.residents.filter(r => r.isSenior);
      return {
        type: 'demographics',
        title: 'AI Demographics Insight: Senior Citizens Registry',
        text: `Found ${BIMS_DATA.stats.seniorCitizens} registered Senior Citizens in Barangay Dacutan. Selected records in view include ${seniors.map(s => s.firstName + ' ' + s.lastName + ' (' + s.purok + ')').join(', ')}.`,
        actionable: 'Filter Table to Seniors',
        data: seniors
      };
    }

    // 2. Vulnerable / Aid Allocation Query
    if (query.includes('aid') || query.includes('relief') || query.includes('4ps') || query.includes('indigent') || query.includes('tabang')) {
      const indigents = BIMS_DATA.residents.filter(r => r.isIndigent || r.is4ps);
      return {
        type: 'aid_recommendation',
        title: 'AI Smart Aid Priority List (Calamity & SAP)',
        text: `AI Vulnerability Score computed. Recommended top priority families for upcoming Dumangas LGU relief: ${indigents.map(r => r.lastName + ' Family (' + r.purok + ')').join(', ')}.`,
        actionable: 'Export Aid Priority CSV',
        data: indigents
      };
    }

    // 3. Blotter / Incident Summarizer & Katarungang Pambarangay Advice
    if (query.includes('blotter') || query.includes('case') || query.includes('dispute') || query.includes('away') || query.includes('reklamo')) {
      const activeCase = BIMS_DATA.blotterRecords[0];
      return {
        type: 'legal_summary',
        title: `AI Case Summarizer: Case #${activeCase.caseNo}`,
        text: `Complainant: ${activeCase.complainant} vs Respondent: ${activeCase.respondent}. Nature: ${activeCase.incidentType}.\n\n⚖️ Legal Guidance under Katarungang Pambarangay (RA 7160 / PD 1508):\n- This case is eligible for Lupon Tagapamayapa conciliation.\n- Suggested Resolution: Execute a Mutual Amicable Settlement (Kasabutan) with clear tethering rules for livestock in Purok 4.`,
        actionable: 'Draft Kasabutan Agreement Document'
      };
    }

    // 4. Draft Barangay Resolution / Ordinance Generator
    if (query.includes('resolution') || query.includes('ordinance') || query.includes('draft') || query.includes('ordinansa')) {
      return {
        type: 'ordinance_draft',
        title: 'AI Generated Draft Barangay Resolution',
        text: `PROPOSED RESOLUTION NO. 2026-08\n\nA RESOLUTION ENACTING THE BARANGAY DACUTAN COASTAL & IRRIGATION CLEANLINESS ORDINANCE OF 2026 IN THE MUNICIPALITY OF DUMANGAS, PROVINCE OF ILOILO.\n\nWHEREAS, Barangay Dacutan is committed to protecting its coastal ecosystem and agricultural water channels;\nWHEREAS, proper waste segregation and livestock management directly impact public health;\nNOW THEREFORE, BE IT RESOLVED by the Sangguniang Barangay of Dacutan in session assembled...`,
        actionable: 'Copy Resolution Template'
      };
    }

    // 5. Default General Smart Assistant Response
    return {
      type: 'general',
      title: 'Barangay Dacutan AI Assistant Response',
      text: `Maayong adlaw! I am your Barangay Dacutan AI Assistant. I can help you filter resident records, generate Katarungang Pambarangay legal summaries, prioritize aid recipients for Dumangas LGU distributions, and draft official barangay resolutions.\n\nTry asking me:\n• "Show senior citizens in Purok 4"\n• "Draft resolution for coastal environmental safety"\n• "Summarize active blotter dispute"\n• "Filter 4Ps families for disaster relief"`,
      actionable: 'Learn More'
    };
  }
};
