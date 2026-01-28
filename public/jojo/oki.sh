 echo "Enter Your Any String : "; 
 read str 
 lower_s=$(echo "$str" | tr 'A-Z' 'a-z') 
 vowel=$(echo "$lower_s" | grep -o "[aeiou]") 
 vowel_c=$(echo "$lower_s" | grep -o "[aeiou]" | wc -l) 
 echo "--> Your Inputed String in Check of Vowel's And Count of vowel's : "; 
 echo ""; 
 echo "  ~Your String : $str "; 
 echo "  ~Your String Vowel's :" $vowel; 
 echo "  ~Count of String Vowel's : $vowel_c ";