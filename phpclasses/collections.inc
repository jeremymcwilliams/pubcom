<?

    $collections=array(
        "ATH"=>array(
            "parentlabel"=>"Athletics",
            "A"=>"Baseball",
            "B"=>"Basketball",
            "C"=>"Cross Country",
            "D"=>"Football",
            "E"=>"Golf",
            "F"=>"Rowing",
            "G"=>"Soccer",
            "H"=>"Softball",
            "I"=>"Swimming",
            "J"=>"Tennis",
            "K"=>"Track and Field",
            "L"=>"Volleyball",
            "X"=>"Recreational Activities"
        ),
        "CAM"=>array(
            "parentlabel"=>"Undergraduate Campus",
            "A"=>"Arials",
            "B"=>"Architectural and Estate Details",
            "C"=>"Lower Campus Landscapes",
            "D"=>"Upper Campus Landscapes",
            "E"=>"Nature",
            "F"=>"Albany Quadrangle",
            "G"=>"BoDine",
            "H"=>"Evans Music Center",
            "I"=>"Fir Acres Theatre",
            "J"=>"Flanagan Chapel",
            "K"=>"Gregg Pavillion",
            "L"=>"Frank Manor House",
            "M"=>"Gatehouse",
            "N"=>"Miller Center for the Humanities",
            "O"=>"Fields Center for the Visual Arts",
            "P"=>"Olin Physics and Chemistry Building",
            "Q"=>"Pamplin Sports Center",
            "R"=>array( /*Residence Halls*/
                "parentlabel"=>"Residence Halls",
                "1"=>"Akin",
                "2"=>"Copeland",
                "3"=>"East",
                "4"=>"Forest",
                "5"=>"Hartzfelt",
                "6"=>"Howard",
                "7"=>"Odell",
                "8"=>"Platt",
                "9"=>"Roberts Hall",
                "10"=>"Stewart",
                "11"=>"West"
            ),
            "S"=>"Templeton Campus Center",
            "T"=>"Watzek Library",
            "U"=>"Hoffman Gallery",
            "V"=>"JR Howard Hall",
            "W"=>"Cooley House"
        ),
        "PEO"=>array(
            "parentlabel"=>"People",
            "A"=>"Group Portraits",
            "B"=>"Individual Portraits",
            "C"=>array( /* Undergraduate Students*/
                "parentlabel"=>"Undergraduate Students",
                "1"=>array( /*Academic*/
                "parentlabel"=>"Academic",
                    "a"=>"outdoors",
                    "b"=>"indoors"
                ),
                "2"=>"Non-academic",
                "3"=>array( /* Campus Living */
                "parentlabel"=>"Undergraduate Students",
                    "a"=>"outdoors",
                    "b"=>"indoors"
                ),
                "4"=>"Individual Prospects",
                "5"=>"Group Portraits"
            
            
            ),
            "D"=>"Alumni Portraits",
            "E"=>"Non Lewis and Clark people"       
        ),
        "DIV"=>array(
            "parentlabel"=>"Divisions",
            "A"=>array(/*Arts and Humanities*/
                "parentlabel"=>"Arts and Humanities",
                "1"=>"Art",
                "2"=>"English",
                "3"=>"Foreign Languages",
                "4"=>"History",
                "6"=>"Music",
                "7"=>"Philosophy",
                "8"=>"Religious Studies",
                "9"=>"Theatre"
            ),
            "B"=>array( /* Math and Natural Sciences */
                "parentlabel"=>"Math and Natural Sciences",
                "1"=>"Biochemistry",
                "2"=>"Biology",
                "3"=>"Chemistry",
                "4"=>"Geological Science",
                "5"=>"Computer Science and Mathematics",
                "6"=>"Physics"
            ),
            "C"=>array( /* Social Sciences  */
                "parentlabel"=>"Social Sciences",
                "1"=>"Communications",
                "2"=>"Economics",
                "3"=>"International Affairs",
                "4"=>"Political Science",
                "5"=>"Psychology",
                "6"=>"Sociology and Anthropology"
            )        
        ),
        "PROG"=>array(
            "parentlabel"=>"Programs",
            "A"=>"Overseas and Off Campus",
            "B"=>"College Outdoors",
            "C"=>"Student Leadership and Service",
            "D"=>"Academic English Studies"
        ),
        "EVNT"=>array(
            "parentlabel"=>"Events",
            "A"=>array( /*Undergraduate Commencement*/
                "parentlabel"=>"Undergraduate Commencement",
                "1"=>"Ceremony",
                "2"=>"Commencement Banquet"
            ),
            "B"=>array( /* Alumni Events  */  
                "parentlabel"=>"Alumni Events",          
                "1"=>"Albany Society",
                "2"=>"Alumni of Color",
                "3"=>"Homecoming",
                "4"=>"Alumni Honors Banquet",
                "5"=>"Legacy Reception",
                "6"=>"Reunion Weekend",
                "7"=>"Receptions"
            ),
            "C"=>array(/* Student Run Events   */
                "parentlabel"=>"Student Run Events",  
                "1"=>"Symposia",
                "2"=>"Hawaii Luau",
                "3"=>"International Fair"
            
            ),
            "D"=>array( /* Development Events    */
              "parentlabel"=>"Development Events",  
                "1"=>"Philanthropy Leadership Dinner",
                "2"=>"Rogers Scholars Lunch",
                "3"=>"Scholarship Recognition Lunch"
            ),
            "E"=>array( /* Undergraduate Events   */
              "parentlabel"=>"Undergraduate Events",  
                "1"=>"Family Weekend",
                "2"=>"New Student Orientation",
                "3"=>"Pio Fair"
            ),
            "F"=>array( /* Institution-wide Events   */
              "parentlabel"=>"Institution-wide Events",  
                "1"=>"Day of Service",
                "2"=>"Glassner Inauguration"           
            ),
            "G"=>"Other"
        ),
        "MISC"=>array(
            "parentlabel"=>"Miscellaneous",
            "A"=>"College Owned Art",
            "B"=>"Objects",
            "C"=>"Location Off Campus",
            "D"=>array( /* Chronicle Magazine   */
                "parentlabel"=>"Chronicle Magazine", 
                "1"=>"Winter 2011",
                "2"=>"Spring 2011",
                "3"=>"Fall 2011"
            ),
            "E"=>"Hoffman Gallery Shows",
            "F"=>array( /* Print Project   */
                "parentlabel"=>"Print Project",
                "1"=>"CAS Viewbook"
            )
        ),
        "L-CAM"=>array(
            
            "A"=>"Aerials",
            "B"=>"Ampitheatre",
            "C"=>"Architecture Details",
            "D"=>"Boley Law Library",
            "E"=>"Gantenbein",
            "F"=>"Swindells Legal Research Center",
            "G"=>"McCarty Classroom Complex",
            "H"=>"Wood Hall"
         ),
        "L-PEO"=>array(
            "A"=>"Group Portraits",
            "B"=>"Individual Portraits",
            "C"=> array( /* Students */
                "parentlabel"=> "Students",
                "1"=>"Indoors",
                "2"=>"Outdoors",
                "3"=>"Individual Portraits",
                "4"=>"Off Campus"
            ),
            "D"=>"Alumni Portraits",
            "E"=>"Faculty",
            "F"=>"Non Lewis and Clark People"
        ),
        "L-EVNT"=>array(
            "A"=>"Commencement",
            "B"=>"Receptions"            
        ),
        "L-MISC"=>array(
            "A"=>"Objects",
            "B"=>array( /* Advocate Magazine*/
                "parentlabel"=> "Advocate Magazine",
                "1"=>"Winter 2011"
            ),
            "C"=>array( /* Print Project */
                "parentlabel"=>"Print Project",
                "1"=>"LAW Viewbook"
            )
        ),
      

        "G-CAM"=>array(
            "A"=>"Rogers Hall",
            "B"=>"Corbett House",
            "C"=>"South Campus Chapel",
            "D"=>"South Campus Landscapes"
        ),
        "G-DEPT"=>array(
            "A"=>"Counseling Psychology",
            "B"=>"Educational Leadership",
            "C"=>"Teacher Education"
        
        ),
        "G-PROG"=>array(
            "A"=>"Northwest Writing Institute"
        ),
        "G-PEO"=>array(
            "A"=>"Group Portraits",
            "B"=>"Individual Portraits",
            "C"=>array( /*Students*/
                "parentlabel"=> "Students",
                "1"=>"Outdoors",
                "2"=>"Individual Portraits"
            ),
            "D"=>"Non Lewis and Clark People"
        ),
        "G-EVNT"=>array(
            "A"=>"Commencement",
            "B"=>"Convocation"
        ),
        "G-MISC"=>array(
            "A"=>array( /* Print Project */
                "parentlabel"=> "Print Project",
                "1"=>"GRAD Viewbook"
            )
        
        )    

    
    );

?>