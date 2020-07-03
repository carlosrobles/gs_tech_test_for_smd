resource "aws_sqs_queue" "new_order_standard_queue" {
  name                        = "new-order-standard"
  fifo_queue                  = false
}

resource "aws_sqs_queue" "item_bundle_standard_queue" {
  name                        = "item-bundle-standard"
  fifo_queue                  = false
}