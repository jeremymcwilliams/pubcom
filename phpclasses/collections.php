<?php

    $collections=array(
        "ATH"=>array(
            "parentlabel"=>"Athletics",
            "A"=>"Baseball (ATH-A)",
            "B"=>"Basketball (ATH-B)",
            "C"=>"Cross Country (ATH-C)",
            "D"=>"Football (ATH-D)",
            "E"=>"Golf (ATH-E)",
            "F"=>"Rowing (ATH-F)",
            "G"=>"Soccer (ATH-G)",
            "H"=>"Softball (ATH-H)",
            "I"=>"Swimming (ATH-I)",
            "J"=>"Tennis (ATH-J)",
            "K"=>"Track and Field (ATH-K)",
            "L"=>"Volleyball (ATH-L)",
            "X"=>"Recreational Activities (ATH-X)"
        ),
        "CAM"=>array(
            "parentlabel"=>"Undergraduate Campus",
            "A"=>"Arials (CAM-A)",
            "B"=>"Architectural and Estate Details (CAM-B)",
            "C"=>"Lower Campus Landscapes (CAM-C)",
            "D"=>"Upper Campus Landscapes (CAM-D)",
            "E"=>"Nature (CAM-E)",
            "F"=>"Albany Quadrangle (CAM-F)",
            "G"=>"BoDine (CAM-G)",
            "H"=>"Evans Music Center (CAM-H)",
            "I"=>"Fir Acres Theatre (CAM-I)",
            "J"=>"Flanagan Chapel (CAM-J)",
            "K"=>"Gregg Pavillion (CAM-K)",
            "L"=>"Frank Manor House (CAM-L)",
            "M"=>"Gatehouse (CAM-M)",
            "N"=>"Miller Center for the Humanities (CAM-N)",
            "O"=>"Fields Center for the Visual Arts (CAM-O)",
            "P"=>"Olin Physics and Chemistry Building (CAM-P)",
            "Q"=>"Pamplin Sports Center (CAM-Q)",
            "R"=>array( /*Residence Halls*/
                "parentlabel"=>"Residence Halls",
                "1"=>"Akin (CAM-R1)",
                "2"=>"Copeland (CAM-R2)",
                "3"=>"East (CAM-R3)",
                "4"=>"Forest (CAM-R4)",
                "5"=>"Hartzfelt (CAM-R5)",
                "6"=>"Howard (CAM-R6)",
                "7"=>"Odell (CAM-R7)",
                "8"=>"Platt (CAM-R8)",
                "9"=>"Roberts Hall (CAM-R9)",
                "10"=>"Stewart (CAM-R10)",
                "11"=>"West (CAM-R11)",
                "12"=>"Holmes (CAM-R12)"
            ),
            "S"=>"Templeton Campus Center (CAM-S)",
            "T"=>"Watzek Library (CAM-T)",
            "U"=>"Hoffman Gallery (CAM-U)",
            "V"=>"JR Howard Hall (CAM-V)",
            "W"=>"Cooley House (CAM-W)"
        ),
        "PEO"=>array(
            "parentlabel"=>"People",
            "A"=>"Group Portraits (PEO-A)",
            "B"=>"Individual Portraits (PEO-B)",
            "C"=>array( /* Undergraduate Students*/
                "parentlabel"=>"Undergraduate Students",
                "1"=>array( /*Academic*/
                "parentlabel"=>"Academic",
                    "a"=>"outdoors (PEO-C1a)",
                    "b"=>"indoors (PEO-C1b)"
                ),
                "2"=>"Non-academic (PEO-C2)",
                "3"=>array( /* Campus Living */
                "parentlabel"=>"Undergraduate Students",
                    "a"=>"outdoors (PEO-C3a)",
                    "b"=>"indoors (PEO-C3b)"
                ),
                "4"=>"Individual Prospects (PEO-C4)",
                "5"=>"Group Portraits (PEO-C5)"
            
            
            ),
            "D"=>"Alumni Portraits (PEO-D)",
            "E"=>"Non Lewis and Clark people (PEO-E)"       
        ),
        "DIV"=>array(
            "parentlabel"=>"Divisions",
            "A"=>array(/*Arts and Humanities*/
                "parentlabel"=>"Arts and Humanities",
                "1"=>"Art (DIV-A1)",
                "2"=>"English (DIV-A2)",
                "3"=>"Foreign Languages (DIV-A3)",
                "4"=>"History (DIV-A4)",
                "6"=>"Music (DIV-A6)",
                "7"=>"Philosophy (DIV-A7)",
                "8"=>"Religious Studies (DIV-A8)",
                "9"=>"Theatre (DIV-A9)"
            ),
            "B"=>array( /* Math and Natural Sciences */
                "parentlabel"=>"Math and Natural Sciences",
                "1"=>"Biochemistry (DIV-B1)",
                "2"=>"Biology (DIV-B2)",
                "3"=>"Chemistry (DIV-B3)",
                "4"=>"Geological Science (DIV-B4)",
                "5"=>"Computer Science and Mathematics (DIV-B5)",
                "6"=>"Physics (DIV-B6)"
            ),
            "C"=>array( /* Social Sciences  */
                "parentlabel"=>"Social Sciences",
                "1"=>"Communications (DIV-C1)",
                "2"=>"Economics (DIV-C2)",
                "3"=>"International Affairs (DIV-C3)",
                "4"=>"Political Science (DIV-C4)",
                "5"=>"Psychology (DIV-C5)",
                "6"=>"Sociology and Anthropology (DIV-C6)"
            )        
        ),
        "PROG"=>array(
            "parentlabel"=>"Programs",
            "A"=>"Overseas and Off Campus (PROG-A)",
            "B"=>"College Outdoors (PROG-B)",
            "C"=>"Student Leadership and Service (PROG-C)",
            "D"=>"Academic English Studies (PROG-D)",
            "E"=>"Entrepreneurship (Winterim) (PROG-E)"
        ),
        "EVNT"=>array(
            "parentlabel"=>"Events",
            "A"=>array( /*Undergraduate Commencement*/
                "parentlabel"=>"Undergraduate Commencement",
                "1"=>"Ceremony (EVNT-A1)",
                "2"=>"Commencement Banquet (EVNT-A2)"
            ),
            "B"=>array( /* Alumni Events  */  
                "parentlabel"=>"Alumni Events",          
                "1"=>"Albany Society (EVNT-B1)",
                "2"=>"Alumni of Color (EVNT-B2)",
                "3"=>"Homecoming (EVNT-B3)",
                "4"=>"Alumni Honors Banquet (EVNT-B4)",
                "5"=>"Legacy Reception (EVNT-B5)",
                "6"=>"Reunion Weekend (EVNT-B6)",
                "7"=>"Receptions (EVNT-B7)"
            ),
            "C"=>array(/* Student Run Events   */
                "parentlabel"=>"Student Run Events",  
                "1"=>"Symposia (EVNT-C1)",
                "2"=>"Hawaii Luau (EVNT-C2)",
                "3"=>"International Fair (EVNT-C3)"
            
            ),
            "D"=>array( /* Development Events    */
              "parentlabel"=>"Development Events",  
                "1"=>"Philanthropy Leadership Dinner (EVNT-D1)",
                "2"=>"Rogers Scholars Lunch (EVNT-D2)",
                "3"=>"Scholarship Recognition Lunch (EVNT-D3)"
            ),
            "E"=>array( /* Undergraduate Events   */
              "parentlabel"=>"Undergraduate Events",  
                "1"=>"Family Weekend (EVNT-E1)",
                "2"=>"New Student Orientation (EVNT-E2)",
                "3"=>"Pio Fair (EVNT-E3)"
            ),
            "F"=>array( /* Institution-wide Events   */
              "parentlabel"=>"Institution-wide Events",  
                "1"=>"Day of Service (EVNT-F1)",
                "2"=>"Glassner Inauguration (EVNT-F2)"           
            ),
            "G"=>"Other (EVNT-G)"
        ),
        "MISC"=>array(
            "parentlabel"=>"Miscellaneous",
            "A"=>"College Owned Art (MISC-A)",
            "B"=>"Objects (MISC-B)",
            "C"=>"Location Off Campus (MISC-C)",
            "D"=>array( /* Chronicle Magazine   */
                "parentlabel"=>"Chronicle Magazine", 
                "1"=>"Winter 2011 (MISC-D1)",
                "2"=>"Spring 2011 (MISC-D2)",
                "3"=>"Fall 2011 (MISC-D3)",
                "4"=>"Winter 2012 (MISC-D4)",
                "5"=>"Spring 2012 (MISC-D5)",
                "6"=>"Fall 2012 (MISC-D6)",
                "7"=>"Winter 2013 (MISC-D7)",
                "8"=>"Spring 2013 (MISC-D8)"
            ),
            "E"=>"Hoffman Gallery Shows (MISC-E)",
            "F"=>array( /* Print Project   */
                "parentlabel"=>"Print Project",
                "1"=>"CAS Viewbook (MISC-F1)"
            )
        ),
        "L-CAM"=>array(
            "parentlabel"=>"Law Campus",
            "A"=>"Aerials (L-CAM-A)",
            "B"=>"Ampitheatre (L-CAM-B)",
            "C"=>"Architecture Details (L-CAM-C)",
            "D"=>"Boley Law Library (L-CAM-D)",
            "E"=>"Gantenbein (L-CAM-E)",
            "F"=>"Swindells Legal Research Center (L-CAM-F)",
            "G"=>"McCarty Classroom Complex (L-CAM-G)",
            "H"=>"Wood Hall (L-CAM-H)"
         ),
        "L-PEO"=>array(
        "parentlabel"=>"Law People",
            "A"=>"Group Portraits (L-PEO-A)",
            "B"=>"Individual Portraits (L-PEO-B)",
            "C"=> array( /* Students */
                "parentlabel"=> "Students",
                "1"=>"Indoors (L-PEO-C1)",
                "2"=>"Outdoors (L-PEO-C2)",
                "3"=>"Individual Portraits (L-PEO-C3)",
                "4"=>"Off Campus (L-PEO-C4)"
            ),
            "D"=>"Alumni Portraits (L-PEO-D)",
            "E"=>"Faculty (L-PEO-E)",
            "F"=>"Non Lewis and Clark People (L-PEO-F)"
        ),
        "L-EVNT"=>array(
            "parentlabel"=>"Law Events",
            "A"=>"Commencement (L-EVNT-A)",
            "B"=>"Receptions (L-EVNT-A)"            
        ),
        "L-MISC"=>array(
            "parentlabel"=>"Law Miscellaneous",
            "A"=>"Objects (L-MISC-A)",
            "B"=>array( /* Advocate Magazine*/
                "parentlabel"=> "Advocate Magazine",
                "1"=>"Winter 2011 (L-MISC-B1)",
                "2"=>"Fall 2011 (L-MISC-B2)",
                "3"=>"Spring 2012 (L-MISC-B3)",
                "4"=>"Fall 2012 (L-MISC-B4)",
                "5"=>"Spring 2013 (L-MISC-B5)"
            ),
            "C"=>array( /* Print Project */
                "parentlabel"=>"Print Project",
                "1"=>"LAW Viewbook (L-MISC-C1)"
            )
        ),
      

        "G-CAM"=>array(
            "parentlabel"=>"Graduate Campus",
            "A"=>"Rogers Hall (G-CAM-A)",
            "B"=>"Corbett House (G-CAM-B)",
            "C"=>"South Campus Chapel (G-CAM-C)",
            "D"=>"South Campus Landscapes (G-CAM-D)",
            "E"=>"Architectural Details (G-CAM-E)"
        ),
        "G-DEPT"=>array(
            "parentlabel"=>"Graduate Departments",
            "A"=>"Counseling Psychology (G-DEPT-A)",
            "B"=>"Educational Leadership (G-DEPT-B)",
            "C"=>"Teacher Education (G-DEPT-C)"
        
        ),
        "G-PROG"=>array(
            "parentlabel"=>"Graduate Programs",
            "A"=>"Northwest Writing Institute (G-PROG-A)"
        ),
        "G-PEO"=>array(
            "parentlabel"=>"Graduate People",
            "A"=>"Group Portraits (G-PEO-A)",
            "B"=>"Individual Portraits (G-PEO-B)",
            "C"=>array( /*Students*/
                "parentlabel"=> "Students",
                "1"=>"Outdoors (G-PEO-C1)",
                "2"=>"Individual Portraits (G-PEO-C2)",
                "3"=>"Indoors (G-PEO-C3)"
            ),
            "D"=>"Non Lewis and Clark People (G-PEO-D)",
            "E"=>"Alumni"
        ),
        "G-EVNT"=>array(
            "parentlabel"=>"Graduate Events",
            "A"=>"Commencement (G-EVNT-A)",
            "B"=>"Convocation (G-EVNT-B)",
            "C"=>"Other (G-EVNT-C)"
        ),
        "G-MISC"=>array(
            "parentlabel"=>"Graduate Miscellaneous",
            "A"=>array( /* Print Project */
                "parentlabel"=> "Print Project",
                "1"=>"GRAD Viewbook (G-MISC-A1)"
            )
        
        )    

    
    );

?>