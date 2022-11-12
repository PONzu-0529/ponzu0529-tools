import { ApiTestBase } from '@/tests/apis/ApiTestBase'
import { VocaloidMusicApiModel } from '@/models/apis/VocaloidMusicApiModel'


class VocaloidMusicApiModelTest extends ApiTestBase {
  public static async getMusicListTest(): Promise<void> { 
    const vocaloidMusicApiModel = new VocaloidMusicApiModel()
    
    const result = await vocaloidMusicApiModel.getMusicList()

    if (result.status !== 'success') {
      console.error('Failure!')
    } else {
      console.log(result.data)
    }
  }
}


(async () => {
  console.log(await VocaloidMusicApiModelTest.getMusicListTest())
}
)()
