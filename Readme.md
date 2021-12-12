Imagck PDF 변환 오류시

> attempt to perform an operation not allowed by the security policy `PDF' @ error/constitute.c/IsCoderAuthorized/408

- /etc/ImageMagick-6/policy.xml 파일 연 후 
- policymap 에 아래 규칙 추가
- ```xml
  <policy domain="coder" rights="read | write" pattern="PDF" />
  ```