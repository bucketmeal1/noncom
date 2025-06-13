CREATE VIEW fhsis_report AS
SELECT 
    ROW_NUMBER() OVER () AS id,
    count,
    result
FROM (
   SELECT 
    COUNT(*) AS count,
    'Proportion of adult (20-59 years old) who were risk assessed using the PhilPEN protocol' AS result
    FROM patients p
    LEFT JOIN consultations c ON p.id = c.patient_id
    LEFT JOIN cervical_cancers cc ON c.id = cc.consultation_id
    WHERE TIMESTAMPDIFF(YEAR, p.birthdate, CURDATE()) BETWEEN 20 AND 59
    AND cc.risk_assessment IS NOT NULL

    UNION ALL

    SELECT 
        COUNT(*) AS count,
        'Proportion of elderly (60 years old and above) who were risk assessed using the PhilPEN protocol' AS result
    FROM patients p
    LEFT JOIN consultations c ON p.id = c.patient_id
    WHERE TIMESTAMPDIFF(YEAR, p.birthdate, CURDATE()) >= 60

    UNION ALL

    SELECT 
        COUNT(*) AS count,
        'Proportion of adult (20-59 years old) who are current smokers based on the PhilPEN protocol' AS result
    FROM patients p
    LEFT JOIN consultations c ON p.id = c.patient_id
    LEFT JOIN ncd_risk_factors rf ON c.id = rf.consultation_id
    WHERE TIMESTAMPDIFF(YEAR, p.birthdate, CURDATE()) BETWEEN 20 AND 59
    AND rf.smoking = 'yes'

    UNION ALL

    SELECT 
        COUNT(*) AS count,
        'Proportion of elderly (60 years old and above) who are current smokers based on the PhilPEN protocol' AS result
    FROM patients p
    LEFT JOIN consultations c ON p.id = c.patient_id
    LEFT JOIN ncd_risk_factors rf ON c.id = rf.consultation_id
    WHERE TIMESTAMPDIFF(YEAR, p.birthdate, CURDATE()) >= 60
    AND rf.smoking = 'yes'

    UNION ALL

    SELECT 
        COUNT(*) AS count,
        'Proportion of adult (20-59 years old) who are current binge drinkers on the PhilPEN protocol' AS result
    FROM patients p
    LEFT JOIN consultations c ON p.id = c.patient_id
    LEFT JOIN ncd_risk_factors rf ON c.id = rf.consultation_id
    WHERE TIMESTAMPDIFF(YEAR, p.birthdate, CURDATE()) BETWEEN 20 AND 59
    AND rf.excessive_alcohol = 'yes'

    UNION ALL

    SELECT 
        COUNT(*) AS count,
        'Proportion of elderly (60 years old and above) who are current binge drinkers on the PhilPEN protocol' AS result
    FROM patients p
    LEFT JOIN consultations c ON p.id = c.patient_id
    LEFT JOIN ncd_risk_factors rf ON c.id = rf.consultation_id
    WHERE TIMESTAMPDIFF(YEAR, p.birthdate, CURDATE()) >= 60
    AND rf.excessive_alcohol = 'yes'

    UNION ALL

    SELECT 
        COUNT(*) AS count,
        'Proportion of adult (20-59 years old) who are overweight or obese' AS result
    FROM patients p
    LEFT JOIN consultations c ON p.id = c.patient_id
    WHERE TIMESTAMPDIFF(YEAR, p.birthdate, CURDATE()) BETWEEN 20 AND 59
    AND c.bmi >= 25

    UNION ALL

    SELECT 
        COUNT(*) AS count,
        'Proportion of elderly (60 years old and above) who are overweight or obese' AS result
    FROM patients p
    LEFT JOIN consultations c ON p.id = c.patient_id
    WHERE TIMESTAMPDIFF(YEAR, p.birthdate, CURDATE()) >= 60
    AND c.bmi >= 25

    UNION ALL

    SELECT 
        COUNT(*) AS count,
        'Proportion of identified hypertensive adults (20-59 years old)' AS result
    FROM patients p
    LEFT JOIN consultations c ON p.id = c.patient_id
    LEFT JOIN diagnoses d ON c.id = d.consultation_id
    WHERE TIMESTAMPDIFF(YEAR, p.birthdate, CURDATE()) BETWEEN 20 AND 59
    AND d.diagnosis = 'Hypertension'

    UNION ALL

    SELECT 
        COUNT(*) AS count,
        'Proportion of identified hypertensive elderly (60 years old and above)' AS result
    FROM patients p
    LEFT JOIN consultations c ON p.id = c.patient_id
    LEFT JOIN diagnoses d ON c.id = d.consultation_id
    WHERE TIMESTAMPDIFF(YEAR, p.birthdate, CURDATE()) >= 60
    AND d.diagnosis = 'Hypertension'

    UNION ALL

    SELECT 
        COUNT(*) AS count,
        'Proportion of identified adults (20-59 years old) with Type 2 Diabetes Mellitus' AS result
    FROM patients p
    LEFT JOIN consultations c ON p.id = c.patient_id
    LEFT JOIN diagnoses d ON c.id = d.consultation_id
    WHERE TIMESTAMPDIFF(YEAR, p.birthdate, CURDATE()) BETWEEN 20 AND 59
    AND d.diagnosis = 'Diabetes Mellitus Type 2'

    UNION ALL

    SELECT 
        COUNT(*) AS count,
        'Proportion of elderly (60 years old and above) with Type 2 Diabetes Mellitus' AS result
    FROM patients p
    LEFT JOIN consultations c ON p.id = c.patient_id
    LEFT JOIN diagnoses d ON c.id = d.consultation_id
    WHERE TIMESTAMPDIFF(YEAR, p.birthdate, CURDATE()) >= 60
    AND d.diagnosis = 'Diabetes Mellitus Type 2'

    UNION ALL

    SELECT 
        COUNT(*) AS count,
        'Proportion of women 20 years old and above screened for cervical cancer using Visual inspection with Acetic acid (VIA) or Pap smear' AS result
    FROM patients p
    LEFT JOIN consultations c ON p.id = c.patient_id
    LEFT JOIN cervical_cancers cc ON c.id = cc.consultation_id
    WHERE p.gender = 'Female'
    AND TIMESTAMPDIFF(YEAR, p.birthdate, CURDATE()) >= 20
    AND cc.type_screening IN ('V-VIA', 'P-Pap Smear')

    UNION ALL

    SELECT 
        COUNT(*) AS count,
        'Proportion of women 20 years old and above found positive or suspect with cervical cancer among those screened' AS result
    FROM patients p
    LEFT JOIN consultations c ON p.id = c.patient_id
    LEFT JOIN cervical_cancers cc ON c.id = cc.consultation_id
    WHERE p.gender = 'Female'
    AND TIMESTAMPDIFF(YEAR, p.birthdate, CURDATE()) >= 20
    AND cc.result IN ('VP-VIA Positive', 'PA-Pap Smear Abnormal')

    UNION ALL

    SELECT 
        COUNT(*) AS count,
        'Proportion of women 20 years old and above with suspicious breast mass' AS result
    FROM patients p
    LEFT JOIN consultations c ON p.id = c.patient_id
    LEFT JOIN diagnoses d ON c.id = d.consultation_id
    WHERE p.gender = 'Female'
    AND TIMESTAMPDIFF(YEAR, p.birthdate, CURDATE()) >= 20
    AND d.diagnosis = 'Suspicious Breast Mass'

    UNION ALL

    SELECT 
        COUNT(*) AS count,
        'Proportion of identified hypertensive adults (20-59 years old) provided with anti hypertensive medications' AS result
    FROM patients p
    LEFT JOIN consultations c ON p.id = c.patient_id
    LEFT JOIN diagnoses d ON c.id = d.consultation_id
    LEFT JOIN management m ON c.id = m.consultation_id
    WHERE TIMESTAMPDIFF(YEAR, p.birthdate, CURDATE()) BETWEEN 20 AND 59
    AND d.diagnosis = 'Hypertension'
    AND m.management = 'Anti hypertensives'

    UNION ALL

    SELECT 
        COUNT(*) AS count,
        'Proportion of identified hypertensive elderly (60 years old and above) provided with antihypertensive medications' AS result
    FROM patients p
    LEFT JOIN consultations c ON p.id = c.patient_id
    LEFT JOIN diagnoses d ON c.id = d.consultation_id
    LEFT JOIN management m ON c.id = m.consultation_id
    WHERE TIMESTAMPDIFF(YEAR, p.birthdate, CURDATE()) >= 60
    AND d.diagnosis = 'Hypertension'
    AND m.management = 'Anti hypertensives'

    UNION ALL

    SELECT 
        COUNT(*) AS count,
        'Proportion of identified type 2 diabetes mellitus adults (20-59 years old) provided with diabetes medication' AS result
    FROM patients p
    LEFT JOIN consultations c ON p.id = c.patient_id
    LEFT JOIN diagnoses d ON c.id = d.consultation_id
    LEFT JOIN management m ON c.id = m.consultation_id
    WHERE TIMESTAMPDIFF(YEAR, p.birthdate, CURDATE()) BETWEEN 20 AND 59
    AND d.diagnosis = 'Diabetes Mellitus Type 2'
    AND m.management = 'Oral hypoglycemic'

    UNION ALL

    SELECT 
        COUNT(*) AS count,
        'Proportion of identified type 2 diabetes mellitus elderly (60 years old and above) provided with diabetes medication' AS result
    FROM patients p
    LEFT JOIN consultations c ON p.id = c.patient_id
    LEFT JOIN diagnoses d ON c.id = d.consultation_id
    LEFT JOIN management m ON c.id = m.consultation_id
    WHERE TIMESTAMPDIFF(YEAR, p.birthdate, CURDATE()) >= 60
    AND d.diagnosis = 'Diabetes Mellitus Type 2'
    AND m.management = 'Oral hypoglycemic'
) AS subquery_alias;
