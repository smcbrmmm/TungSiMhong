<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = new Product();
        $product->product_code = "PSG1895100";
        $product->product_name = 'กระดาษเงินกระทอง';
        $product->product_price = "39";
        $product->product_quantity = '100';
        $product->product_weight = '50';
        $product->product_detail ='กระดาษเงินกระดาษทองสำหรับเผาให้บรรพบุรุษในวันเทศกาลไหว้บรรพบุรุษ';
        $product->img ='/imgProduct/8b.jpg';
        $product->save();

        $product = new Product();
        $product->product_code = "TSG1896333";
        $product->product_name = 'ธูปมังกร 3ดอก';
        $product->product_price = "89";
        $product->product_quantity = '120';
        $product->product_weight = '30';
        $product->product_detail ='ธูปมังกร ธูปอักษร ธูปอวยพร ใส่กล่องไม้  สำหรับไหว้เจ้าขอพร  ตามเทศกาลต่างๆ ใช้ได้ทั้ง ไหว้ในบ้าน และไหว้ที่ศาลเจ้า  ไหว้ไฉ่ซิ้งเอี้ย';
        $product->img ='/imgProduct/rr.jpg';
        $product->save();

        $product = new Product();
        $product->product_code = "TSG1896334";
        $product->product_name = 'กระถางธูปไฟฟ้า 3ดอก';
        $product->product_price = "290";
        $product->product_quantity = '50';
        $product->product_weight = '420';
        $product->product_detail ='กระถางธูปไฟฟ้าสีทอง ลายหงส์มังกร';
        $product->img ='/imgProduct/กระถางไฟฟ้า.jpg';
        $product->save();

        $product = new Product();
        $product->product_code = "WWH2226463";
        $product->product_name = 'กระถางธูป ฮก แดง';
        $product->product_price = "120";
        $product->product_quantity = '75';
        $product->product_weight = '200';
        $product->product_detail ='กระถางธูป มีที่ปักเทียนขาไม้ 2ข้าง เหมาะสำหรับใช้นอกบ้าน หรือนอกสถานที่ สะดวก เคลื่ินย้ายง่าย ตกไม่แตก รูปลายสวยงาม อย่างเช่น ไหม้เทพเจ้าไฉ่ซิ้งเอี้ย หรือเทพเจ้าฟ้าดิน หรือการไหว้เจ้าที่กลางแจ้ง';
        $product->img ='/imgProduct/tang.jpg';
        $product->save();

        $product = new Product();
        $product->product_code = "PTT0092564";
        $product->product_name = 'ปฏิทินไทย-จีน 2564';
        $product->product_price = "145";
        $product->product_quantity = '100';
        $product->product_weight = '150';
        $product->product_detail ='ปฏิทินไทย-ปี2564จากสำนักโหราศาสตร์น่ำเอี๊ยง ของแท้ได้มาตรฐาน เก็บดูวันธงชัย วันเปิดร้าน วันดี วันชงต่างๆ';
        $product->img ='/imgProduct/cal.jpg';
        $product->save();

        $product = new Product();
        $product->product_code = "STG3952562";
        $product->product_name = 'สร้อยมุก ถวายเจ้าแม่กวนอิม';
        $product->product_price = "39";
        $product->product_quantity = '200';
        $product->product_weight = '20';
        $product->product_detail ='สร้อยมุก ถวายเจ้าแม่กวนอิม หรือ สามารถนำมาใส่คู่กับชุดไทย';
        $product->img ='/imgProduct/muk.jpg';
        $product->img ='/imgProduct/muk.jpg';
        $product->save();

        $product = new Product();
        $product->product_code = "PDSD002009";
        $product->product_name = 'ผ้าดิบ สีแดง';
        $product->product_price = "100";
        $product->product_quantity = '45';
        $product->product_weight = '20';
        $product->product_detail ='ผ้าดิบ หน้ากว้าง 90ซม. แบ่งขายเป็นเมตร ';
        $product->img ='/imgProduct/dib.jpg';
        $product->img ='/imgProduct/dib.jpg';
        $product->save();

        $product = new Product();
        $product->product_code = "CARD001444";
        $product->product_name = 'รถกระดาษทำมือ';
        $product->product_price = "20";
        $product->product_quantity = '100';
        $product->product_weight = '20';
        $product->product_detail ='รถกระดาษทำด้วยมือสำหรับเผาในวันไหว้บรรพบุรษ';
        $product->img ='/imgProduct/fo.jpg';
        $product->save();

        $product = new Product();
        $product->product_code = "BGDD002559";
        $product->product_name = 'บ้านกระดาษทำมือ';
        $product->product_price = "30";
        $product->product_quantity = '100';
        $product->product_weight = '30';
        $product->product_detail ='บ้านกระดาษทำด้วยมือสำหรับเผาในวันไหว้บรรพบุรษ';
        $product->img ='/imgProduct/z1.jpg';
        $product->save();

        $product = new Product();
        $product->product_code = "GUCC002511";
        $product->product_name = 'รองเท้า GUCCI';
        $product->product_price = "30";
        $product->product_quantity = '120';
        $product->product_weight = '30';
        $product->product_detail ='รองเท้า GUCCI กระดาษทำมือทำด้วยมือสำหรับเผาในวันไหว้บรรพบุรษให้ท่านๆบรรพบุรุษได้ใส่เดินเก๋ๆ';
        $product->img ='/imgProduct/br.jpg';
        $product->save();

        $product = new Product();
        $product->product_code = "GUCC0024569";
        $product->product_name = 'กระทงดอกบัวกระดาษ';
        $product->product_price = "25";
        $product->product_quantity = '100';
        $product->product_weight = '25';
        $product->product_detail ='กระทงดอกบัวกระดาษทำด้วยมือสำหรับเผาในวันไหว้บรรพบุรษ';
        $product->img ='/imgProduct/36.jpg';
        $product->save();

        $product = new Product();
        $product->product_code = "CHUD001998";
        $product->product_name = 'ชุดไหว้บรรพบุรุษ 1';
        $product->product_price = "230";
        $product->product_quantity = '50';
        $product->product_weight = '400';
        $product->product_detail ='ชุดไหว้บรรพบุรุษแบบจบในชุดเดียว ไม่จำเป็นต้องไปซื้ออย่างอื่นแยก';
        $product->img ='/imgProduct/1.jpg';
        $product->save();

        $product = new Product();
        $product->product_code = "BANK2019789";
        $product->product_name = 'แบงค์กระดาษ';
        $product->product_price = "45";
        $product->product_quantity = '200';
        $product->product_weight = '120';
        $product->product_detail ='แบงค์กระดาษสำหรับการไหว้บรรพบุรุษ ให้ท่านๆบรรพบุรุษบนสวรรค์ทั้งหลายได้มีเงินใช้ไม่ขาดมือ';
        $product->img ='/imgProduct/yz.jpg';
        $product->save();

        $product = new Product();
        $product->product_code = "GOLD201911";
        $product->product_name = 'ทองแท่งกระดาษ';
        $product->product_price = "45";
        $product->product_quantity = '200';
        $product->product_weight = '140';
        $product->product_detail ='ทองคำแท่งกระดาษสำหรับการไหว้บรรพบุรุษ ให้ท่านๆบรรพบุรุษบนสวรรค์ทั้งหลายได้มีเงินใช้ไม่ขาดมือ';
        $product->img ='/imgProduct/5j.jpg';
        $product->save();

        $product = new Product();
        $product->product_code = "GOLD201900";
        $product->product_name = 'เหรียญเงินเหรียญทองกระดาษ';
        $product->product_price = "35";
        $product->product_quantity = '200';
        $product->product_weight = '130';
        $product->product_detail ='เหรียญเงินเหรียญทองกระดาษสำหรับการไหว้บรรพบุรุษ ให้ท่านๆบรรพบุรุษบนสวรรค์ทั้งหลายได้มีเงินใช้ไม่ขาดมือ';
        $product->img ='/imgProduct/8b.jpg';
        $product->save();

        $product = new Product();
        $product->product_code = "PACK201900";
        $product->product_name = 'ชุดไหว้บรรพบุรุษ 2';
        $product->product_price = "230";
        $product->product_quantity = '75';
        $product->product_weight = '420';
        $product->product_detail ='ชุดไหว้บรรพบุรุษแบบจบในชุดเดียว ไม่จำเป็นต้องไปซื้ออย่างอื่นแยก';
        $product->img ='/imgProduct/2v.jpg';
        $product->save();

        $product = new Product();
        $product->product_code = "PACK201901";
        $product->product_name = 'ชุดไหว้ไฉ่ซิงเอี้ย';
        $product->product_price = "200";
        $product->product_quantity = '40';
        $product->product_weight = '550';
        $product->product_detail ='ชุดไหว้ไฉ่ซิงเอี้ยแบบจบในชุดเดียว ไม่จำเป็นต้องไปซื้ออย่างอื่นแยก';
        $product->img ='/imgProduct/i4.jpg';
        $product->save();

        $product = new Product();
        $product->product_code = "PACK201903";
        $product->product_name = 'ชุดไหว้เจ้าที่';
        $product->product_price = "175";
        $product->product_quantity = '50';
        $product->product_weight = '400';
        $product->product_detail ='ชุดไหว้เจ้าที่แบบจบในชุดเดียว ไม่จำเป็นต้องไปซื้ออย่างอื่นแยก';
        $product->img ='/imgProduct/6r.jpg';
        $product->save();
    }
}
