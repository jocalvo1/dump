<?php
require_once('../../assets/vendor/tcpdf/tcpdf.php');

// Create new PDF document
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

// Set margins
$pdf->SetMargins(10, 10, 10); // Set a margin of 1 cm (10 mm)
$pdf->setPrintHeader(false);

// Add a page
$pdf->AddPage();


// Get the width and height of the page
$pageWidth = $pdf->getPageWidth();
$pageHeight = $pdf->getPageHeight();

// Image size (adjust as needed)
$imageWidth = 180; // Width of the image
$imageHeight = 180; // Height of the image

// Calculate the position to center the image
$xPosition = ($pageWidth - $imageWidth) / 2; // Center the image horizontally
$yPosition = ($pageHeight - $imageHeight) / 2; // Center the image vertically

// Add a semi-transparent background image (Sagay logo)
$pdf->SetAlpha(0.05); // Set the transparency (0 = fully transparent, 1 = fully opaque)
$pdf->Image('../../assets/img/Rizal.png', $xPosition, $yPosition, $imageWidth, $imageHeight, 'PNG', '', 'T', true, 100, '', false, false, 0);
$pdf->SetAlpha(1); // Reset transparency to normal for the rest of the document


// Add logos
$pdf->Image('../../assets/img/Sagay.png', 10, 10, 20, 20, 'PNG', '', 'T', true, 100, '', false, false, 0);
$pdf->Image('../../assets/img/Negros.png', 180, 10, 20, 20, 'PNG', '', 'T', true, 100, '', false, false, 0);

$pdf->SetFont('helvetica', '', 12); // Normal Arial font, 12pt
$pdf->SetXY(10, 15); // Set position for the title block

// Add a MultiCell for the entire block of text
$pdf->MultiCell(
    190, // Cell width (span across the page width, minus margins)
    5,   // Line height
    "REPUBLIC OF THE PHILIPPINES\nPROVINCE OF NEGROS OCCIDENTAL\nCITY OF SAGAY\nCITY HEALTH OFFICE", // The content
    0,   // No border
    'C', // Center alignment
    false // Transparent background
);

// Add a horizontal rule
$pdf->SetLineWidth(0.2); // Line thickness
$pdf->Line(10, 40, 200, 40); // Horizontal line (X1, Y1, X2, Y2)

// Add border
$pdf->SetXY(10, 45); // Move below the horizontal rule
$pdf->SetLineWidth(0.2); // Set thinner line for the border
$pdf->SetFont('helvetica', '', 10);
$pdf->Cell(190, 230, '', 1, 1, 'L', false); // Draw the border (W, H, border, line break)

// Inside the border
$pdf->SetXY(12, 50); // Set position slightly inside the border
$pdf->SetFont('helvetica', '', 10); // Normal font

// First part (label and last name)
// Patient's Name Section
$pdf->Cell(40, 5, "Patients' Name: ", 0, 0, 'L'); // Label
$pdf->SetX(45); // Move the cursor after the label\

// Draw an underline under the patient's name
$pdf->SetXY(12, 55); // Set the Y position for the underline (adjust as needed)
$pdf->Line(40, 55, 200, 55); // X1, Y1, X2, Y2 (line from 12,55 to 200,55)

// Smaller text: "PLS. WRITE LEGIBLY IN PRINT"
$pdf->SetFont('helvetica', 'I', 5); // Italic, smaller font for the note
$pdf->Cell(0, 5, 'PLS. WRITE LEGIBLY IN PRINT', 0, 0, 'L'); // No line break

// Set position for the labels under the names (Surname, First Name, Middle Name) on the same row
$pdf->SetFont('helvetica', '', 8); // Normal font for the labels

// Set XY for labels directly after "PLS. WRITE LEGIBLY IN PRINT"
$pdf->SetXY(45, 55); // Position after "PLS. WRITE LEGIBLY IN PRINT"
$pdf->Cell(0, 5, '( Surname )', 0, 0, 'L'); // Surname label

$pdf->SetXY(80, 55); // Position under First Name
$pdf->Cell(0, 5, '( First Name )', 0, 0, 'L'); // First Name label

$pdf->SetXY(155, 55); // Position under Middle Initial
$pdf->Cell(0, 5, '( Middle Name )', 0, 1, 'L'); // Middle Name label




$pdf->SetXY(12, 60); // Set position slightly inside the border
$pdf->SetFont('helvetica', '', 10); // Normal font
$pdf->Cell(0, 5, "Address: ", 0, 0, 'L');

$pdf->SetX(75); // Move the cursor after the Address
$pdf->Cell(0, 5, "Date of Birth: ", 0, 0, 'L'); // Birth Date


$pdf->SetX(140); // Move the cursor after the birthday
$pdf->Cell(0, 5, "Birth Place: ", 0, 0, 'L'); // Place of Birth


// Line after Patients
$pdf->SetXY(12, 55); // Set the Y position for the underline (adjust as needed)
$pdf->Line(10, 65, 200, 65); // X1, Y1, X2, Y2 (line from 12,55 to 200,55)


$pdf->SetXY(12, 65); // Set position slightly inside the border
$pdf->SetFont('helvetica', '', 10); // Normal font
$pdf->Cell(0, 5, "Age : ", 0, 0, 'L');

$pdf->SetX(30);
$pdf->Cell(0, 5, "Male / Female :", 0, 0, 'L'); 


$pdf->SetX(67);
$pdf->Cell(0, 5, "Status : ", 0, 0, 'L'); 

$pdf->SetX(100);
$pdf->Cell(0, 5, "Nationality : ", 0, 0, 'L'); 

$pdf->SetX(145);
$pdf->Cell(0, 5, "Occupation : ", 0, 0, 'L'); 

//underscores

// Underline for Age
$pdf->SetX(21); 
$pdf->Cell(20, 5, str_repeat('_', 4), 0, 0, 'L'); // 15 underscores

// Underline for Male / Female
$pdf->SetX(55); 
$pdf->Cell(20, 5, str_repeat('_', 5), 0, 0, 'L');

// Underline for Status
$pdf->SetX(80); 
$pdf->Cell(20, 5, str_repeat('_', 9), 0, 0, 'L');

// Underline for Nationality
$pdf->SetX(120); 
$pdf->Cell(30, 5, str_repeat('_', 10), 0, 0, 'L');

// Underline for Occupation
$pdf->SetX(167); 
$pdf->Cell(30, 5, str_repeat('_', 16), 0, 0, 'L');



$pdf->SetXY(12, 70); // Set position slightly inside the border
$pdf->SetFont('helvetica', '', 10); // Normal font
$pdf->Cell(0, 5, "PATIENT IS : ", 0, 0, 'L');

// Add the checkbox logic for each option (Head, Wife, Mother, Father, Daughter, Son)
$pdf->SetFont('helvetica', '', 7); // Set smaller font

// HEAD OF FAMILY
$pdf->SetX(38);
$pdf->Cell(0, 5, "___", 0, 0, 'L');
$pdf->SetX(43);
$pdf->Cell(0, 5, "HEAD OF FAMILY", 0, 0, 'L');

// WIFE OF HEAD OF FAMILY
$pdf->SetX(65);
$pdf->Cell(0, 5, "___", 0, 0, 'L');
$pdf->SetX(70);
$pdf->Cell(0, 5, "WIFE OF HEAD OF FAMILY", 0, 0, 'L');

// FATHER
$pdf->SetX(105);
$pdf->Cell(0, 5, "___", 0, 0, 'L');
$pdf->SetX(110);
$pdf->Cell(0, 5, "FATHER", 0, 0, 'L');

// MOTHER
$pdf->SetX(123);
$pdf->Cell(0, 5, "___", 0, 0, 'L');
$pdf->SetX(128);
$pdf->Cell(0, 5, "MOTHER", 0, 0, 'L');

// DAUGHTER
$pdf->SetX(141);
$pdf->Cell(0, 5, "___", 0, 0, 'L');
$pdf->SetX(146);
$pdf->Cell(0, 5, "DAUGHTER", 0, 0, 'L');

// SON
$pdf->SetX(162);
$pdf->Cell(0, 5, "___", 0, 0, 'L');
$pdf->SetX(167);
$pdf->Cell(0, 5, "SON", 0, 0, 'L');

$pdf->SetX(175);
$pdf->Cell(0, 5, "OTHERS", 0, 0, 'L'); 

$pdf->SetX(186);
$pdf->Cell(0, 5, "_______", 0, 0, 'L'); 

// Line after Patient is\
$pdf->Line(10, 75, 200, 75); // X1, Y1, X2, Y2 (line from 12,55 to 200,55)



$pdf->SetXY(12, 75); // Set position slightly inside the border
$pdf->SetFont('helvetica', '', 7); // Normal font
$pdf->Cell(0, 5, "DSWD 4Ps MEMBER ", 0, 0, 'L');

$pdf->SetX(37);
$pdf->Cell(0, 5, "___", 0, 0, 'L'); 

$pdf->SetX(41);
$pdf->Cell(0, 5, "YES", 0, 0, 'L'); 

$pdf->SetX(47);
$pdf->Cell(0, 5, "___", 0, 0, 'L'); 

$pdf->SetX(52);
$pdf->Cell(0, 5, "NO", 0, 0, 'L'); 

$pdf->SetX(58);
$pdf->Cell(0, 5, "PHILHEALTH MEMBER", 0, 0, 'L'); 

$pdf->SetX(86);
$pdf->Cell(0, 5, "___", 0, 0, 'L'); 

$pdf->SetX(91);
$pdf->Cell(0, 5, "YES", 0, 0, 'L'); 

$pdf->SetX(97);
$pdf->Cell(0, 5, "___", 0, 0, 'L'); 

$pdf->SetX(103);
$pdf->Cell(0, 5, "NO", 0, 0, 'L'); 

$pdf->SetX(109);
$pdf->Cell(0, 5, "___", 0, 0, 'L'); 

$pdf->SetX(114);
$pdf->Cell(0, 5, "DEPENDENT", 0, 0, 'L'); 

$pdf->SetX(132);
$pdf->Cell(0, 5, "EKONSULTA MEMBER", 0, 0, 'L'); 

$pdf->SetX(160);
$pdf->Cell(0, 5, "___", 0, 0, 'L'); 

$pdf->SetX(165);
$pdf->Cell(0, 5, "YES", 0, 0, 'L'); 

$pdf->SetX(172);
$pdf->Cell(0, 5, "___", 0, 0, 'L'); 

$pdf->SetX(177);
$pdf->Cell(0, 5, "NO", 0, 0, 'L'); 

$pdf->Line(10, 80, 200, 80); // X1, Y1, X2, Y2 (line from 12,55 to 200,55)




$pdf->SetXY(12, 80); // Set position slightly inside the border
$pdf->SetFont('helvetica', '', 7); // Normal font
$pdf->Cell(0, 5, "PHIC ID No. ", 0, 0, 'L');

$pdf->SetX(26); 
$pdf->Cell(20, 5, str_repeat('_', 23), 0, 0, 'L');

$pdf->SetX(60);
$pdf->Cell(0, 5, "PHILHEALTH CATEGORY", 0, 0, 'L'); 

$pdf->SetX(91);
$pdf->Cell(0, 5, "___", 0, 0, 'L');

$pdf->SetX(96);
$pdf->Cell(0, 5, "INDIGENT", 0, 0, 'L'); 

$pdf->SetFont('helvetica', '', 6); // Normal font
$pdf->SetX(110);
$pdf->Cell(0, 5, "IF NOT PLS SPECIFY: ", 0, 0, 'L');

$pdf->Line(10, 85, 200, 85); // X1, Y1, X2, Y2 (line from 12,55 to 200,55)



$pdf->SetXY(12, 85); // Set position slightly inside the border
$pdf->SetFont('helvetica', '', 11); // Normal font
$pdf->Cell(0, 5, "PARENT/GUARDIAN ", 0, 0, 'L');

$pdf->SetX(50);
$pdf->SetFont('helvetica', '', 8); // Normal font
$pdf->Cell(0, 5, "IN CASE MINOR: ", 0, 0, 'L');

$pdf->Line(10, 90, 200, 90); // X1, Y1, X2, Y2 (line from 12,55 to 200,55)


// Set position and draw the border for each label (Rectangle)
$pdf->SetLineWidth(0.2); // Set line width for the border
$pdf->SetFont('helvetica', '', 11); // Set font

// Draw square for "DATE"
$pdf->SetXY(10, 90); // Set position for the top-left corner of "DATE"
$pdf->Rect(10, 90, 30, 5); // Draw a square (x, y, width, height)
$pdf->Cell(30, 5, "DATE", 0, 0, 'C'); // Center the text inside the square

// Draw square for "S"
$pdf->SetXY(40, 90); // Set position for the top-left corner of "S"
$pdf->Rect(40, 90, 40, 5); // Draw a square
$pdf->Cell(40, 5, "S", 0, 0, 'C'); // Center the text inside the square

// Draw square for "O"
$pdf->SetXY(80, 90); // Set position for the top-left corner of "O"
$pdf->Rect(80, 90, 40, 5); // Draw a square
$pdf->Cell(40, 5, "O", 0, 0, 'C'); // Center the text inside the square

// Draw square for "A"
$pdf->SetXY(120, 90); // Set position for the top-left corner of "A"
$pdf->Rect(120, 90, 40, 5); // Draw a square
$pdf->Cell(40, 5, "A", 0, 0, 'C'); // Center the text inside the square

// Draw square for "P"
$pdf->SetXY(160, 90); // Set position for the top-left corner of "P"
$pdf->Rect(160, 90, 40, 5); // Draw a square
$pdf->Cell(40, 5, "P", 0, 0, 'C'); // Center the text inside the square




$pdf->SetFont('helvetica', '', 11);

// Set dotted line style for the table borders
$pdf->SetLineWidth(0.2); // Line width for the table border
$pdf->SetDrawColor(0, 0, 0); // Black color for the border
$pdf->SetLineStyle(array('dash' => 1, 'space' => 1)); // Dotted style


$yPosition = 95;  // Starting Y-coordinate

for ($i = 0; $i <= 35; $i++) {
    $pdf->SetXY(10, $yPosition);
    $pdf->Cell(30, 5, '', 1, 0, 'C');
    $pdf->Cell(40, 5, '', 1, 0, 'C');
    $pdf->Cell(40, 5, '', 1, 0, 'L');
    $pdf->Cell(40, 5, '', 1, 0, 'C');
    $pdf->Cell(40, 5, '', 1, 1, 'C');
    
    $yPosition += 5;  // Increment the Y-coordinate by 5 for the next row
}


// Output the PDF
$pdf->Output('patient_form.pdf', 'I'); // 'I' to display in browser, 'D' to force download
?>
