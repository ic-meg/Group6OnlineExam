const provinces = {
    "NCR": ["Metro Manila"],
    "CAR": ["Abra", "Apayao", "Benguet", "Ifugao", "Kalinga", "Mountain Province"],
    "I": ["Ilocos Norte", "Ilocos Sur", "La Union", "Pangasinan"],
    "II": ["Batanes", "Cagayan", "Isabela", "Nueva Vizcaya", "Quirino"],
    "III": ["Aurora", "Bataan", "Bulacan", "Nueva Ecija", "Pampanga", "Tarlac", "Zambales"],
    "IVA": ["Cavite", "Laguna", "Batangas", "Rizal", "Quezon"],
    "IVB": ["Marinduque", "Occidental Mindoro", "Oriental Mindoro", "Palawan", "Romblon"],
    "V": ["Albay", "Camarines Norte", "Camarines Sur", "Catanduanes", "Masbate", "Sorsogon"],
    "VI": ["Aklan", "Antique", "Capiz", "Iloilo", "Negros Occidental"],
    "VII": ["Bohol", "Cebu", "Negros Oriental", "Siquijor"],
    "VIII": ["Biliran", "Eastern Samar", "Leyte", "Northern Samar", "Samar", "Southern Leyte"],
    "IX": ["Zamboanga del Norte", "Zamboanga del Sur", "Zamboanga Sibugay"],
    "X": ["Bukidnon", "Camiguin", "Lanao del Norte", "Misamis Occidental", "Misamis Oriental"],
    "XI": ["Davao de Oro", "Davao del Norte", "Davao del Sur", "Davao Oriental", "Davao City"],
    "XII": ["Cotabato", "Sarangani", "South Cotabato", "Sultan Kudarat"],
    "XIII": ["Agusan del Norte", "Agusan del Sur", "Surigao del Norte", "Surigao del Sur"],
    "BARMM": ["Basilan", "Lanao del Sur", "Maguindanao", "Sulu", "Tawi-Tawi"]
};

const towns = {
    "Metro Manila": {
        "Manila": "1000", "Makati": "1200", "Quezon City": "1100", "Pasig": "1600",
        "Taguig": "1630", "Mandaluyong": "1550", "San Juan": "1500", "Marikina": "1800",
        "Caloocan": "1400", "Valenzuela": "1440", "Malabon": "1470", "Navotas": "1485",
        "Pateros": "1620", "Pasay": "1300", "Muntinlupa": "1770", "Las Piñas": "1740"
    },
    "Abra": {
        "Bangued": "2800", "Boliney": "2811", "Lagayan": "2812", "Langiden": "2813",
        "Luba": "2814", "Peñarrubia": "2815", "Pidal": "2816", "Sallapadan": "2817",
        "San Isidro": "2818", "San Juan": "2819", "San Quintin": "2820", "Tayum": "2821"
    },
    "Apayao": {
        "Conner": "3810", "Calanasan": "3820", "Kabugao": "3814", "Pudtol": "3813",
        "Santa Marcela": "3811", "Villasis": "3812"
    },
    "Benguet": {
        "La Trinidad": "2601", "Atok": "2602", "Bokod": "2603", "Buguias": "2604",
        "Itogon": "2605", "Kibungan": "2606", "Mankayan": "2607", "Sablan": "2608",
        "Tuba": "2609", "Tublay": "2610"
    },
    "Ifugao": {
        "Lamut": "3601", "Lagawe": "3602", "Natonin": "3603", "Banaue": "3604",
        "Hungduan": "3605", "Potia": "3606", "Pudtol": "3607", "Tinoc": "3608"
    },
    "Kalinga": {
        "Tabuk": "3800", "Pasil": "3801", "Balbalan": "3802", "Lubuagan": "3803",
        "Rizal": "3804", "Pinukpuk": "3805", "Tinglayan": "3806", "Aparri": "3807"
    },
    "Mountain Province": {
        "Bauko": "2615", "Bontoc": "2616", "Sabangan": "2617", "Sadanga": "2618",
        "Sagada": "2619", "Tadian": "2620"
    },
    "Ilocos Norte": {
        "Laoag": "2900", "Batac": "2901", "Paoay": "2902", "Vintar": "2903",
        "Pagudpud": "2904", "Sarrat": "2905", "Solsona": "2906", "Dingras": "2907",
        "Currimao": "2908", "Bacarra": "2909"
    },
    "Ilocos Sur": {
        "Vigan": "2700", "Candon": "2701", "Narvacan": "2702", "Suyo": "2703",
        "Santa Maria": "2704", "Tagudin": "2705", "Santiago": "2706", "Santa Lucia": "2707"
    },
    "La Union": {
        "San Fernando": "2500", "Agoo": "2501", "Bauang": "2502", "Naguilian": "2503",
        "Aringay": "2504", "Burgos": "2505", "Caba": "2506", "Luna": "2507",
        "San Juan": "2508", "Santol": "2509"
    },
    "Pangasinan": {
        "Lingayen": "2401", "Dagupan": "2402", "San Carlos": "2403", "Urdaneta": "2404",
        "Alaminos": "2405", "Rosales": "2406", "Calasiao": "2407", "Villasis": "2408",
        "Binmaley": "2409", "Sual": "2410"
    },
    "Batanes": {
        "Basco": "3900", "Itbayat": "3901", "Ivana": "3902", "Sabtang": "3903",
        "Uyugan": "3904", "Valanga": "3905"
    },
    "Cagayan": {
        "Tuguegarao": "3500", "Lal-lo": "3501", "Gattaran": "3502", "Peñablanca": "3503",
        "Lasam": "3504", "Claveria": "3505", "Buguey": "3506", "Piat": "3507",
        "Amulung": "3508", "Sanchez Mira": "3509"
    },
    "Isabela": {
        "Ilagan": "3300", "Cauayan": "3301", "Santiago": "3302", "Alicia": "3303",
        "Gamu": "3304", "Roxas": "3305", "Santiago": "3306", "Santo Tomas": "3307"
    },
    "Nueva Vizcaya": {
        "Bayombong": "3700", "Solano": "3701", "Aritao": "3702", "Dupax del Norte": "3703",
        "Dupax del Sur": "3704", "Ambaguio": "3705", "Bagabag": "3706", "Diadi": "3707"
    },
    "Quirino": {
        "Cabarroguis": "3400", "Nagtipunan": "3401", "Diffun": "3402", "Aglipay": "3403",
        "Saguday": "3404", "Maddela": "3405", "Nagtipunan": "3406"
    },
    "Aurora": {
        "Baler": "3200", "Casiguran": "3201", "Dilasag": "3202", "Dipaculao": "3203",
        "Maria Aurora": "3204", "San Luis": "3205", "San Vicente": "3206", "Aurora": "3207"
    },
    "Bataan": {
        "Balanga": "2100", "Orani": "2101", "Samal": "2102", "Limay": "2103",
        "Dinalupihan": "2104", "Hermosa": "2105", "Morong": "2106", "Pilar": "2107",
        "Mariveles": "2108", "Abucay": "2109"
    },
    "Bulacan": {
        "Malolos": "3000", "Meycauayan": "3020", "San Jose del Monte": "3023", "San Ildefonso": "3024",
        "San Miguel": "3025", "San Rafael": "3026", "Baliwag": "3006", "Guiguinto": "3015",
        "Santa Maria": "3009", "Plaridel": "3004"
    },
    "Nueva Ecija": {
        "Palayan": "3100", "Gapan": "3101", "Cabanatuan": "3102", "San Jose": "3103",
        "Science City of Munoz": "3110", "San Isidro": "3104", "San Leonardo": "3105",
        "Santa Rosa": "3106", "Jaen": "3107", "Cabiao": "3108"
    },
    "Pampanga": {
        "San Fernando": "2000", "Angeles": "2009", "Mabalacat": "2010", "Apalit": "2016",
        "Masantol": "2018", "Guagua": "2004", "Lubao": "2005", "Mexico": "2006",
        "Pampanga": "2007", "Porac": "2008"
    },
    "Tarlac": {
        "Tarlac City": "2300", "Concepcion": "2301", "La Paz": "2302", "Paniqui": "2303",
        "Ramos": "2304", "San Jose": "2305", "San Manuel": "2306", "San Miguel": "2307",
        "Victoria": "2308", "Capas": "2309"
    },
    "Zambales": {
        "Iba": "2200", "Olongapo": "2201", "Subic": "2202", "Castillejos": "2203",
        "San Antonio": "2204", "San Felipe": "2205", "San Marcelino": "2206", "San Narciso": "2207",
        "San Salvador": "2208", "San Luis": "2209", "Masinloc": "2210"
    },
    "Batangas": {
        "Agoncillo": "4214", "Batangas City": "4200", "Bauan": "4201", "Batangas": "4200",
        "Lipa City": "4217", "Lobo": "4218", "Mabini": "4202", "Malvar": "4233",
        "San Jose": "4227", "San Juan": "4226", "San Luis": "4231", "San Pascual": "4206",
        "Santa Teresita": "4215", "Santo Tomas": "4234", "Taal": "4208", "Tanauan City": "4230",
        "Taysan": "4215", "Tingloy": "4213"
    },
    "Marinduque": {
        "Boac": "4900", "Gasan": "4901", "Mogpog": "4902", "Santa Cruz": "4903",
        "Santa Fe": "4904", "Torrijos": "4905"
    },
    "Occidental Mindoro": {
        "Mamburao": "5100", "San Jose": "5101", "Rizal": "5102", "Paluan": "5103",
        "Abra de Ilog": "5104", "Calintaan": "5105", "Lubang": "5106", "Looc": "5107"
    },
    "Oriental Mindoro": {
        "Calapan": "5200", "Gloria": "5201", "Puerto Galera": "5202", "San Teodoro": "5203",
        "San Jose": "5204", "Baco": "5205", "Roxas": "5206", "Mansalay": "5207"
    },
    "Palawan": {
        "Puerto Princesa": "5300", "Coron": "5316", "El Nido": "5313", "Roxas": "5306",
        "San Vicente": "5309", "Culion": "5311", "Araceli": "5308", "Balabac": "5310"
    },
    "Romblon": {
        "Romblon": "5500", "Odiongan": "5501", "San Fernando": "5502", "Alcantara": "5503",
        "Alibagon": "5504", "Cajidiocan": "5505", "San Agustin": "5506", "San Andres": "5507",
        "San Jose": "5508", "San Roque": "5509"
    },
    "Albay": {
        "Legazpi City": "4500", "Daraga": "4501", "Tabaco": "4502", "Ligao": "4503",
        "Guinobatan": "4504", "Malilipot": "4505", "Oas": "4506", "Polangui": "4507",
        "Rapu-Rapu": "4508", "Camalig": "4509", "Manito": "4510"
    },
    "Camarines Norte": {
        "Daet": "4600", "Basud": "4601", "Mercedes": "4602", "San Vicente": "4603",
        "Vinzons": "4604", "Labo": "4605", "Paracale": "4606", "Jose Panganiban": "4607"
    },
    "Camarines Sur": {
        "Naga City": "4400", "Iriga City": "4401", "Baao": "4402", "Bato": "4403",
        "Buhi": "4404", "Cabusao": "4405", "Caramoan": "4406", "Del Gallego": "4407",
        "Lupi": "4408", "Pili": "4409", "Sagñay": "4410"
    },
    "Catanduanes": {
        "Virac": "4800", "Pandan": "4801", "Payo": "4802", "San Andres": "4803",
        "San Miguel": "4804", "Bagamanoc": "4805", "Caramoran": "4806", "San Jose": "4807"
    },
    "Masbate": {
        "Masbate City": "5400", "Mandaon": "5401", "Placer": "5402", "Cataingan": "5403",
        "Balud": "5404", "San Pascual": "5405", "Uson": "5406", "Dimasalang": "5407",
        "Mobo": "5408", "Aroroy": "5409"
    },
    "Sorsogon": {
        "Sorsogon City": "4700", "Casiguran": "4701", "Gubat": "4702", "Irosin": "4703",
        "Juban": "4704", "Magallanes": "4705", "Pili": "4706", "Prieto Diaz": "4707",
        "Bulusan": "4708", "Donsol": "4709"
    },
    "Aklan": {
        "Kalibo": "5600", "Malay": "5601", "Numancia": "5602", "Ibajay": "5603",
        "Banga": "5604", "Batan": "5605", "Madalag": "5606", "Makato": "5607",
        "Balete": "5608", "Lezo": "5609"
    },
    "Antique": {
        "San Jose": "5700", "Hamtic": "5701", "Sibalom": "5702", "Valderrama": "5703",
        "San Remigio": "5704", "Tibiao": "5705", "Belison": "5706", "Bugasong": "5707",
        "Anini-y": "5708", "Patnongon": "5709"
    },
    "Capiz": {
        "Roxas City": "5800", "Panay": "5801", "Ivisan": "5802", "Maayon": "5803",
        "President Roxas": "5804", "Pilar": "5805", "Dao": "5806", "Sigma": "5807",
        "Mambusao": "5808", "Jamindan": "5809"
    },
    "Iloilo": {
        "Iloilo City": "5000", "Passi City": "5001", "Leganes": "5002", "Oton": "5003",
        "San Miguel": "5004", "San Rafael": "5005", "Alimodian": "5006", "Janiuay": "5007",
        "Pavia": "5008", "Santa Barbara": "5009"
    },
    "Negros Occidental": {
        "Bacolod City": "6100", "Bago City": "6101", "Binalbagan": "6102", "Cadiz City": "6103",
        "Himamaylan": "6104", "La Carlota": "6105", "Sagay City": "6106", "San Carlos": "6107",
        "Silay City": "6108", "Talisay City": "6109"
    },
    "Bohol": {
        "Tagbilaran City": "6300", "Dauis": "6301", "Panglao": "6302", "Ubay": "6303",
        "Anda": "6304", "Balilihan": "6305", "Batuan": "6306", "Loon": "6307",
        "Talibon": "6308", "Tubigon": "6309"
    },
    "Cebu": {
        "Cebu City": "6000", "Mandaue City": "6014", "Lapu-Lapu City": "6015", "Toledo City": "6031",
        "Danao City": "6004", "Carcar City": "6019", "Naga City": "6037", "Bogo City": "6012",
        "Talisay City": "6045", "Sogod": "6018"
    },
    "Negros Oriental": {
        "Dumaguete City": "6200", "Bayawan": "6201", "Bais City": "6202", "Guihulngan": "6203",
        "Tanjay": "6204", "Amlan": "6205", "Canlaon": "6206", "Zamboanguita": "6207",
        "Siquijor": "6208"
    },
    "Siquijor": {
        "Siquijor": "6220", "Lazi": "6221", "San Juan": "6222", "Sibulan": "6223",
        "San Antonio": "6224", "Larena": "6225", "Maria": "6226"
    },
    "Biliran": {
        "Biliran": "6540", "Caibiran": "6541", "Cabucgayan": "6542", "Kawayan": "6543",
        "Maripipi": "6544", "Naval": "6545"
    },
    "Eastern Samar": {
        "Borongan City": "6810", "Gandara": "6820", "General MacArthur": "6830",
        "Guiuan": "6819", "Llorente": "6811", "Oras": "6821", "Samar": "6820",
        "San Julian": "6812", "San Policarpo": "6813", "Taft": "6814"
    },
    "Leyte": {
        "Tacloban City": "6500", "Ormoc City": "6541", "Baybay City": "6521", "Abuyog": "6510",
        "Palo": "6501", "Tanauan": "6502", "Jaro": "6522", "Carigara": "6523",
        "Leyte": "6520", "San Miguel": "6524"
    },
    "Northern Samar": {
        "Catarman": "6400", "Palapag": "6410", "Pambujan": "6420", "San Isidro": "6430",
        "San Jose": "6440", "San Roque": "6450", "Laoang": "6460"
    },
    "Samar": {
        "Calbayog City": "6710", "Catbalogan City": "6711", "Basey": "6712", "Marabut": "6713",
        "Matuguinao": "6714", "San Sebastian": "6715", "Santa Margarita": "6716",
        "Santa Rita": "6717", "Tagapul-an": "6718"
    },
    "Southern Leyte": {
        "Maasin City": "6600", "Bontoc": "6610", "Hinunangan": "6611", "Hinundayan": "6612",
        "Libagon": "6613", "Sogod": "6614", "St. Bernard": "6615", "Silago": "6616",
        "Tomas Oppus": "6617"
    },
    "Zamboanga del Norte": {
        "Dipolog City": "7100", "Dapitan City": "7101", "Sibutad": "7110", "Sergio Osmeña Sr.": "7111",
        "Godod": "7112", "Jose Dalman": "7113", "Katipunan": "7114", "Rizal": "7115",
        "Siayan": "7116"
    },
    "Zamboanga del Sur": {
        "Pagadian City": "7016", "Dipolog City": "7100", "Sominot": "7017", "Midsalip": "7018",
        "Labangan": "7019", "Guipos": "7020", "Dumingag": "7021", "Zamboanga City": "7000"
    },
    "Zamboanga Sibugay": {
        "Ipil": "7020", "Naga": "7021", "Payao": "7022", "Titay": "7023", "Olutanga": "7024",
        "Malangas": "7025", "Diplahan": "7026"
    },
    "Bukidnon": {
        "Malaybalay City": "8700", "Valencia City": "8709", "Manolo Fortich": "8710",
        "Maramag": "8712", "Kadingilan": "8713", "Kitaotao": "8714", "Talakag": "8715",
        "Baungon": "8716", "Libona": "8717", "Pangantucan": "8718", "Dangcagan": "8719",
        "Cabanglasan": "8720", "Sumilao": "8721"
    },
    "Camiguin": {
        "Mambajao": "9100", "Catarman": "9101", "Sagay": "9102", "Guinsiliban": "9103",
        "Tibasi": "9104", "Mahinog": "9105"
    },
    "Lanao del Norte": {
        "Iligan City": "9200", "Kapatagan": "9212", "Kauswagan": "9201", "Lala": "9213",
        "Linamon": "9214", "Maigo": "9202", "Sapang Dalaga": "9203", "Salvador": "9204",
        "Tangoan": "9205"
    },
    "Misamis Occidental": {
        "Ozamiz City": "7200", "Tangub City": "7201", "Sinacaban": "7202", "Tudela": "7203",
        "Concepcion": "7204", "Plaridel": "7205", "Don Victoriano": "7206", "Oroquieta": "7207",
        "Jimenez": "7208", "Panaon": "7209"
    },
    "Misamis Oriental": {
        "Cagayan de Oro": "9000", "Gingoog City": "9001", "El Salvador": "9002", "Jasaan": "9003",
        "Tagoloan": "9004", "Villanueva": "9005", "Magsaysay": "9006", "Opol": "9007",
        "Claveria": "9008", "Salay": "9009", "Sugbongcogon": "9010"
    },
    "Davao de Oro": {
        "Nabunturan": "8800", "Montevista": "8801", "New Bataan": "8802", "Laak": "8803",
        "Maragusan": "8804", "Mawab": "8805", "Pantukan": "8806", "Tagum City": "8100"
    },
    "Davao del Norte": {
        "Tagum City": "8100", "Panabo City": "8101", "Samal City": "8119", "Kapalong": "8118",
        "Talaingod": "8117", "Asuncion": "8116", "San Isidro": "8115", "Sto. Tomas": "8114"
    },
    "Davao del Sur": {
        "Digos City": "8000", "Santa Cruz": "8001", "Bansalan": "8002", "Hagonoy": "8003",
        "Sulop": "8004", "Kiblawan": "8005", "Malalag": "8006", "Magsaysay": "8007",
        "Santa Maria": "8008", "Padada": "8009"
    },
    "Davao Oriental": {
        "Mati City": "8200", "Baganga": "8201", "Boston": "8202", "Cateel": "8203",
        "Caraga": "8204", "Manay": "8205", "San Isidro": "8206", "San Vicente": "8207"
    },
    "Davao City": {
        "Davao City": "8000"  // Note: Davao City is listed here separately from Davao del Norte
    },
    "Cotabato": {
        "Kidapawan City": "9400", "Makilala": "9401", "M'lang": "9402", "Pikit": "9403",
        "Presidential Office": "9404", "Tulunan": "9405", "Antipas": "9406", "Alamada": "9407",
        "Kabacan": "9408"
    },
    "Sarangani": {
        "Alabel": "9500", "Malungon": "9501", "Kiamba": "9502", "Maasim": "9503",
        "Maitum": "9504", "Glan": "9505", "Malapatan": "9506", "Sarangani": "9507"
    },
    "South Cotabato": {
        "Koronadal City": "9500", "Polomolok": "9501", "Tupi": "9502", "Surallah": "9503",
        "Banga": "9504", "Lake Sebu": "9505", "Tantangan": "9506", "Norala": "9507"
    },
    "Sultan Kudarat": {
        "Isulan": "9800", "Tacurong City": "9801", "Kalamansig": "9802", "Lambayong": "9803",
        "Lutayan": "9804", "Sen. Ninoy Aquino": "9805", "Palimbang": "9806", "Bagumbayan": "9807"
    },
    "Tawi-Tawi": {
        "Bongao": "9700", "Simunul": "9701", "Tandubas": "9702", "Turtle Islands": "9703",
        "Sapa-Sapa": "9704", "Sitangkai": "9705", "Pag-asa": "9706"
    },
    "Cavite": {
        "Alfonso": "4123", "Amadeo": "4119", "Bacoor": "4102", "Cabuyao": "4025",
        "Cavite City": "4100", "Dasmariñas": "4114", "General Emilio Aguinaldo": "4126",
        "General Mariano Alvarez": "4118", "General Trias": "4107", "Imus": "4103",
        "Kawit": "4104", "Magallanes": "4115", "Maragondon": "4122", "Mendez": "4121",
        "Naic": "4119", "Noveleta": "4108", "Rosario": "4106", "Silang": "4118",
        "Tagaytay": "4120", "Tanza": "4118", "Ternate": "4117"
    },
    "Laguna": {
        "Alaminos": "4001", "Bay": "4033", "Biñan": "4024", "Cabuyao": "4025",
        "Calamba": "4027", "Calauan": "4012", "Famy": "4014", "Kalayaan": "4012",
        "Liliw": "4033", "Los Baños": "4030", "Luisiana": "4011", "Mabitac": "4015",
        "Magdalena": "4008", "Majayjay": "4036", "Nagcarlan": "4009", "Paete": "4030",
        "Pagsanjan": "4008", "Palo": "4031", "San Pablo": "4000", "San Pedro": "4023",
        "San Vicente": "4001", "Santa Cruz": "4009", "Santa Maria": "4001", "Santa Rosa": "4026",
        "Santo Tomas": "4234", "Siniloan": "4013"
    },
    "Batangas": {
        "Agoncillo": "4214", "Batangas City": "4200", "Bauan": "4201", "Batangas": "4200",
        "Lipa City": "4217", "Lobo": "4218", "Mabini": "4202", "Malvar": "4233",
        "Maracay": "4233", "San Jose": "4227", "San Juan": "4226", "San Luis": "4231",
        "San Nicolas": "4201", "San Pascual": "4206", "Santa Teresita": "4215", "Santo Tomas": "4234",
        "Taal": "4208", "Tanauan City": "4230", "Taysan": "4215", "Tingloy": "4213"
    },
    "Rizal": {
        "Antipolo": "1870", "Baras": "1970", "Binangonan": "1940", "Cainta": "1900",
        "Cardona": "1950", "Jala-Jala": "1990", "Montalban": "1860", "Rodriguez": "1860",
        "San Mateo": "1850", "Tanay": "1980", "Taytay": "1920", "Teresa": "1890"
    },
    "Quezon": {
        "Agdangan": "4330", "Alabat": "4309", "Atimonan": "4333", "Buenavista": "4300",
        "Candelaria": "4322", "Catanauan": "4306", "Dolores": "4322", "Gumaca": "4305",
        "Guinayangan": "4304", "Mauban": "4320", "Padre Burgos": "4307", "Pagbilao": "4324",
        "Pitogo": "4331", "Plaridel": "4330", "Quezon": "4300", "Sariaya": "4322",
        "Tiaong": "4321", "Unisan": "4330"
    }
};

function updateProvinces() {
    const regionSelect = document.getElementById('region');
    const provinceSelect = document.getElementById('province');
    const selectedRegion = regionSelect.value;

  
    provinceSelect.innerHTML = '<option value="">Select Province</option>';

    if (selectedRegion && provinces[selectedRegion]) {
        provinces[selectedRegion].forEach(province => {
            const option = document.createElement('option');
            option.value = province;
            option.textContent = province;
            provinceSelect.appendChild(option);
        });
    }
  
    const townSelect = document.getElementById('town');
    townSelect.innerHTML = '<option value="">Select Town</option>';
    document.getElementById('zip-code').value = '';
}

function updateTowns() {
    const provinceSelect = document.getElementById('province');
    const townSelect = document.getElementById('town');
    const zipCodeInput = document.getElementById('zip-code');
    const selectedProvince = provinceSelect.value;

    // Clear previous options
    townSelect.innerHTML = '<option value="">Select Town</option>';
    zipCodeInput.value = '';

    if (selectedProvince && towns[selectedProvince]) {
        Object.entries(towns[selectedProvince]).forEach(([town, zipCode]) => {
            const option = document.createElement('option');
            option.value = town;
            option.textContent = town;
            townSelect.appendChild(option);
        });
    }
}

function updateZipCode() {
    const townSelect = document.getElementById('town');
    const zipCodeInput = document.getElementById('zip-code');
    const selectedTown = townSelect.value;

    if (selectedTown) {
        Object.entries(towns).forEach(([province, townsList]) => {
            if (townsList[selectedTown]) {
                zipCodeInput.value = townsList[selectedTown];
            }
        });
    } else {
        zipCodeInput.value = '';
    }
}


document.getElementById('region').addEventListener('change', updateProvinces);
document.getElementById('province').addEventListener('change', updateTowns);
document.getElementById('town').addEventListener('change', updateZipCode);

document.getElementById('cellphone-number').addEventListener('input', function (e) {
const value = e.target.value.replace(/\D/g, ''); 
if (value.length > 11) {
    e.target.value = value.slice(0, 11); 
} else {
    e.target.value = value; 
}
});

function validateNumber(input) {
    input.value = input.value.replace(/[^0-9]/g, '');
}



// //Reset and Success Modal


document.addEventListener('DOMContentLoaded', function() {
    const resetButton = document.querySelector('button[name="savePersonal"][value="Reset Personal Information"]');
    const resetModal = new bootstrap.Modal(document.getElementById('resetModal'));
    const successModal = new bootstrap.Modal(document.getElementById('successModal'));
    const resetSuccessModal = new bootstrap.Modal(document.getElementById('resetSuccessModal'));
    const resetForm = document.getElementById('resetForm');

    if (resetButton) {
        resetButton.addEventListener('click', function(event) {
            event.preventDefault(); 
            resetModal.show();
        });
    }

    if (resetForm) {
        resetForm.addEventListener('submit', function(event) {
            event.preventDefault();
            
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'reset_personal.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    resetModal.hide();
                    resetSuccessModal.show();
                } else {
                    alert('Error resetting family background information.');
                }
            };
            xhr.send('action=reset'); // Modify according to your PHP script
        });
    }

    const goToApplicationFormButton = document.getElementById('goToApplicationForm');
    if (goToApplicationFormButton) {
        goToApplicationFormButton.addEventListener('click', function() {
            window.location.href = 'applicationform.php';
        });
    }

    const goToApplicationFormAfterResetButton = document.getElementById('goToApplicationFormAfterReset');
    if (goToApplicationFormAfterResetButton) {
        goToApplicationFormAfterResetButton.addEventListener('click', function() {
            window.location.href = 'applicationform.php';
        });
    }
});



