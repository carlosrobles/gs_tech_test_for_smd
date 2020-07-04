data "archive_file" "partner_invoice_zip" {
  type        = "zip"
  output_path = "../functions/index.zip"
  source_file = "../functions/dist/index.js"
}

resource "aws_lambda_function" "invoice_partner" {
  filename      = data.archive_file.partner_invoice_zip.output_path
  function_name = "partner_invoice"
  role          = "arn:aws:iam::521151258604:role/sqs_lambda"
  handler       = "index.partnerInvoice"
  source_code_hash = filebase64sha256(data.archive_file.partner_invoice_zip.output_path)
  runtime = "nodejs12.x"
}

resource "aws_lambda_event_source_mapping" "invoice_partner" {
  event_source_arn = aws_sqs_queue.new_order_standard_queue.arn
  function_name    = aws_lambda_function.invoice_partner.arn
}