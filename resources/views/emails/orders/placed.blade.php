<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<style>
    body { font-family: 'Helvetica Neue', Arial, sans-serif; background-color: #f4f5f7; margin: 0; padding: 0; }
    .email-container { max-width: 600px; margin: 40px auto; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
    .header { background: linear-gradient(135deg, #ff4757, #ff6b81); padding: 40px 20px; text-align: center; color: white; }
    .header h1 { margin: 0; font-size: 28px; font-weight: bold; letter-spacing: 1px; }
    .header p { margin: 10px 0 0; font-size: 16px; opacity: 0.9; }
    .content { padding: 40px 30px; color: #333333; line-height: 1.6; }
    .content h2 { margin-top: 0; font-size: 22px; color: #2d3436; }
    .order-card { background-color: #f8f9fa; border-radius: 8px; padding: 20px; margin: 25px 0; border: 1px solid #eeeeee; }
    .order-row { display: flex; justify-content: space-between; border-bottom: 1px solid #eeeeee; padding: 12px 0; }
    .order-row:last-child { border-bottom: none; }
    .label { font-weight: 600; color: #636e72; }
    .value { font-weight: bold; color: #2d3436; text-align: right; }
    .total-row { font-size: 18px; color: #ff4757; }
    .action-btn { display: inline-block; background-color: #ff4757; color: #ffffff !important; text-decoration: none; padding: 14px 28px; border-radius: 8px; font-weight: bold; margin-top: 20px; text-align: center; }
    .footer { text-align: center; padding: 30px; font-size: 14px; color: #999999; border-top: 1px solid #eeeeee; background-color: #fdfdfd; }
</style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>FOODZONE</h1>
            <p>Your Premium Dining Experience Awaits</p>
        </div>
        <div class="content">
            <h2>Hello {{ $order->custname }},</h2>
            <p>Thank you for choosing <strong>FoodZone</strong>! Your order has been successfully placed. Our master chefs have received your request and are beginning to prepare your delicacies.</p>
            
            <div class="order-card">
                <div class="order-row" style="display: table; width: 100%; border-bottom: 1px solid #eee; padding: 12px 0;">
                    <div style="display: table-cell; font-weight: 600; color: #636e72;">Order ID</div>
                    <div style="display: table-cell; text-align: right; font-weight: bold; color: #2d3436;">#FZ-{{ $order->id }}</div>
                </div>
                <div class="order-row" style="display: table; width: 100%; border-bottom: 1px solid #eee; padding: 12px 0;">
                    <div style="display: table-cell; font-weight: 600; color: #636e72;">Payment Method</div>
                    <div style="display: table-cell; text-align: right; font-weight: bold; color: #2d3436;">{{ $order->shippingtype }}</div>
                </div>
                <div class="order-row" style="display: table; width: 100%; border-bottom: 1px solid #eee; padding: 12px 0;">
                    <div style="display: table-cell; font-weight: 600; color: #636e72; padding-right: 20px;">Address</div>
                    <div style="display: table-cell; text-align: right; font-weight: normal; color: #2d3436;">{{ $order->address }}</div>
                </div>
                <div class="order-row total-row" style="display: table; width: 100%; padding: 12px 0;">
                    <div style="display: table-cell; font-weight: 600; color: #ff4757; font-size: 18px;">Total Amount</div>
                    <div style="display: table-cell; text-align: right; font-weight: bold; color: #ff4757; font-size: 18px;">₹{{ $order->total }}</div>
                </div>
            </div>

            <p style="text-align: center;">
                <a href="{{ url('/myorder') }}" class="action-btn">Track Your Order</a>
            </p>

            <p style="margin-top: 30px;">If you have any questions or need to modify your order, please contact our premium support team.</p>
            <p>Bon Appétit!<br><strong>Team FoodZone</strong></p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} FoodZone Administration. All rights reserved.<br>
            <small>This is an automated email, please do not reply to this address.</small>
        </div>
    </div>
</body>
</html>
