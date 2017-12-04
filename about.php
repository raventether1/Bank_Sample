
<?php
include('top.php');
//Display title


?>
<h3>About Our Hashing Algorithm</h3>
<p>
At Raven's Bank, we use advanced methods to encrypt your data. The algorithm we use is the SHA-512 algorithm.
</p>
<p>
In order to encrypt your data, we use the sha512 algorithm. The compression function used in the SHA-512 algorithm operates on a 1024-bitmessage block. It also uses a 512-bitintermediate hash value. The SHA-512 algorithm operates on eight 64-bit words, but the procedure that the algorithm applies to the words is incredibly similar to the procedure used in the SHA-256 algorithm. The performance of the SHA-512 hinges on the overall length of the hashed message. Normally, the SHA-512 can be viewed as a single call of a function that initializes the eight 64bit variable h0, h1, h2, h3, h4, h5, h6, h7. This initial function is then proceeded by a series of calls of an update function, and then finally an invocation of a finalize function. The finalize function contains of one or two invocations of the update function, depending on the overall length of the data object to be encrypted. The SHA-512 algorithm is essentially a 512-bit block cipher algorithm which encrypts the intermediate hash value using the message block as key.
</p>

<h3>Citations</h3>
<ul>
<li>Gueron, S., Johnson, S., & Walker, J. (n.d.). SHA-512/256. Retrieved November 13, 2017, from https://eprint.iacr.org/2010/548.pdf
</li>
<li>
Savard, J. (2017). A Cryptographic Compendium. Reston, VA: The Math Forum at NCTM.
</li>
</ul>

<?php

//footer with copyright symbol and php displaying the current year
echo "<footer>&copy; Raven Tether - ".date("Y")."</footer>";

?>

</body>
</html>