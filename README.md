- [CHANGE LOG](#change-log)
  - [15/05/2021 20:00](#15052021-2000)
    - [Value Code Of [Task Status]](#value-code-of-task-status)
  - [17/05/2021 21:36](#17052021-2136)
    - [Module TASK](#module-task)
      - [Quyền USER](#quyền-user)
  - [10:10 AM 5/18/2021](#1010-am-5182021)
    - [Module LOGIN](#module-login)
    - [Layout](#layout)
    - [Module TASK DETAIL](#module-task-detail)
    - [Module TASK](#module-task-1)

# CHANGE LOG
## 15/05/2021 20:00
### Value Code Of [Task Status]
`1 - Vừa nhận`<br>
`2 - Đang thực hiện`<br>
`3 - Trì hoãn`<br>
`4 - Hoàn tất`<br>

## 17/05/2021 21:36
### Module TASK
#### Quyền USER
1) Cập nhật TASK (trạng thái)

## 10:10 AM 5/18/2021
### Module LOGIN
1 - Thêm thuộc tính <b>fullname</b> trong Session

### Layout
<ol>
    <li>Thay đổi hiển thị trên header bằng fullname thay vì email</li>
    <li>Thêm badge hiển thị quyền hạn trên header (frontend)</li>
</ol>

### Module TASK DETAIL
<ol>
    <li>Hiển thị nút XÓA CÔNG VIỆC theo quyền (chỉ có admin và trưởng phòng mới có nút này)</li>
</ol>

### Module TASK
<ol>
    <li>Thêm chức năng: SỬA</li>
    <li>Admin: Được chỉnh sửa Tất cả Field + Tất cả phòng ban</li>
    <li>Trưởng phòng: Chỉnh sửa Tất cả Field + Chỉ phòng ban do người đó quản lý</li>
    <li>Nhân viên: Chỉ được chỉnh sửa Trạng thái công việc</li>
</ol>

