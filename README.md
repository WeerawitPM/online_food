# วิธีการติดตั้ง
#### 1. สร้างฐานข้อมูลชื่อ fooddelivery
#### 2. สร้างตารางผู้ดูแลระบบชื่อ admin
ข้อมูลในตาราง admin ประกอบด้วย

| Name | Type | Length | Null Index | Auto Increment |
| --- | --- | --- | --- | --- |
| id | int | - | Primary | Yes |
| email | varchar | 255 | Unique | No |
| username | varchar | 255 | Unique | No |
| password | varchar | 255 | - | No |
| firstname | varchar | 255 | - | No |
| lastname | varchar | 255 | - | No |
| phone | varchar | 10 | - | No |

#

#### 3. สร้างตารางลูกค้าชื่อ customer
ข้อมูลในตาราง customer ประกอบด้วย

| Name | Type | Length | Default | Null Index | Auto Increment |
| --- | --- | --- | --- | --- | --- |
| id | int | - | - | Primary | Yes |
| email | varchar | 255 | - | Unique | No |
| username | varchar | 255 | - | Unique | No |
| password | varchar | 255 | - | - | No |
| firstname | varchar | 255 | - | - | No |
| lastname | varchar | 255 | - | - | No |
| phone | varchar | 10 | - | - | No |
| address | varchar | 255 | - | - | No |
| image | varchar | 255 | - | - | No |
| status | varchar | 255 | ปกติ | - | No |

#

#### 4. สร้างตารางร้านอาหารชื่อ restaurant
ข้อมูลในตาราง restaurant ประกอบด้วย

| Name | Type | Length | Default | Null Index | Auto Increment |
| --- | --- | --- | --- | --- | --- |
| id | int | - | - | Primary | Yes |
| email | varchar | 255 | - | Unique | No |
| username | varchar | 255 | - | Unique | No |
| password | varchar | 255 | - | - | No |
| firstname | varchar | 255 | - | - | No |
| lastname | varchar | 255 | - | - | No |
| phone | varchar | 10 | - | - | No |
| address | varchar | 255 | - | - | No |
| image | varchar | 255 | - | - | No |
| restaurant_name | varchar | 255 | - | - | No |
| restaurant_type | varchar | 255 | - | - | No |
| status | varchar | 255 | รอการอนุมัติ | - | No |

#

#### 5. สร้างตารางประเภทร้านอาหารชื่อ restaurant_type
ข้อมูลในตาราง restaurant_type ประกอบด้วย

| Name | Type | Length | Null Index | Auto Increment |
| --- | --- | --- | --- | --- |
| id | int | - | Primary | Yes |
| name | varchar | 255 | Unique | No |

#

#### 6. สร้างตารางหมวดหมู่อาหารชื่อ food_category
ข้อมูลในตาราง food_category ประกอบด้วย

| Name | Type | Length | Null Index | Auto Increment |
| --- | --- | --- | --- | --- |
| id | int | - | Primary | Yes |
| name | varchar | 255 | - | No |
| restaurant_id | int | 11 | - | No |

#

#### 7. สร้างตารางเมนูอาหารชื่อ food
ข้อมูลในตาราง food ประกอบด้วย

| Name | Type | Length | Null Index | Auto Increment |
| --- | --- | --- | --- | --- |
| id | int | - | Primary | Yes |
| name | varchar | 255 | - | No |
| price | int | 11 | No | - |
| detail | varchar | 255 | - | No |
| image | varchar | 255 | - | No |
| food_category | varchar | 255 | - | No |
| restaurant_id | int | 11 | - | No |

#

#### 8. สร้างตารางคนส่งอาหารชื่อ rider
ข้อมูลในตาราง rider ประกอบด้วย

| Name | Type | Length | Default | Null Index | Auto Increment |
| --- | --- | --- | --- | --- | --- |
| id | int | - | - | Primary | Yes |
| email | varchar | 255 | - | Unique | No |
| username | varchar | 255 | - | Unique | No |
| password | varchar | 255 | - | - | No |
| firstname | varchar | 255 | - | - | No |
| lastname | varchar | 255 | - | - | No |
| phone | varchar | 10 | - | - | No |
| address | varchar | 255 | - | - | No |
| car_no | varchar | 255 | Unique | - | No |
| image | varchar | 255 | - | - | No |
| status | varchar | 255 | รอการอนุมัติ | - | No |
| status_order | varchar | 255 | รอรับออเดอร์ | - | No |

#

#### 9. สร้างตารางรายการสั่งอาหารชื่อ food_order
ข้อมูลในตาราง food_order ประกอบด้วย

| Name | Type | Length | Default | Null Index | Auto Increment |
| --- | --- | --- | --- | --- | --- |
| id | int | - | - | Primary | Yes |
| food_id | varchar | 255 | - | - | No |
| food_count | int | 4 | - | - | No |
| price | int | 5 | - | - | No |
| customer_id | int | 11 | - | - | No |
| restaurant_id | int | 11 | - | - | No |
| rider_id | int | 11 | - | - | No |
| status | varchar | 255 | รอคนขับ | - | No |

#